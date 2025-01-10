<?php

namespace App\Http\Controllers\Backend;

use Google_Client;
use Google_Service_Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GoogleCalendarController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect_uri'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType(config('services.google.access_type'));
        $this->client->setApprovalPrompt(config('services.google.approval_prompt'));
        $this->client->setPrompt(config('services.google.prompt'));
        $this->client->setIncludeGrantedScopes(true);
    }

    public function connect()
    {
        // Eğer kullanıcı zaten bağlıysa
        if (Auth::user()->google_calendar_token) {
            return redirect()->back()->with('info', 'Google Calendar zaten bağlı.');
        }

        // Google'a yönlendir
        $authUrl = $this->client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        if (!$request->has('code')) {
            \Log::error('Google Calendar callback - code parametresi eksik');
            return redirect()->route('customer-works.index')
                ->with('error', 'Google Calendar bağlantısı başarısız oldu.');
        }

        try {
            \Log::debug('Google Calendar callback başladı', [
                'code' => $request->code
            ]);

            // Token al
            $token = $this->client->fetchAccessTokenWithAuthCode($request->code);
            
            \Log::debug('Token alındı', [
                'token' => $token
            ]);

            // Calendar servisini başlat
            $service = new Google_Service_Calendar($this->client);
            
            // Varsayılan takvimi al
            $calendarList = $service->calendarList->listCalendarList();
            $primaryCalendar = null;
            foreach ($calendarList->getItems() as $calendarListEntry) {
                if ($calendarListEntry->primary) {
                    $primaryCalendar = $calendarListEntry;
                    break;
                }
            }

            \Log::debug('Takvim bilgileri alındı', [
                'calendar_id' => $primaryCalendar ? $primaryCalendar->id : null
            ]);

            // Kullanıcı bilgilerini güncelle
            $user = Auth::user();
            $user->google_calendar_token = json_encode($token);
            $user->google_calendar_id = $primaryCalendar ? $primaryCalendar->id : 'primary';
            $user->google_calendar_connected_at = now();
            $user->save();

            \Log::debug('Kullanıcı bilgileri güncellendi', [
                'user_id' => $user->id,
                'calendar_id' => $user->google_calendar_id,
                'token' => $user->google_calendar_token ? 'var' : 'yok'
            ]);

            // Config'i temizle
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');

            return redirect()->route('customer-works.index')
                ->with('success', 'Google Calendar başarıyla bağlandı.');

        } catch (\Exception $e) {
            \Log::error('Google Calendar callback hatası: ' . $e->getMessage(), [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('customer-works.index')
                ->with('error', 'Google Calendar bağlantısı sırasında bir hata oluştu.');
        }
    }

    public function disconnect()
    {
        try {
            $user = Auth::user();
            
            if ($user->google_calendar_token) {
                // Token'ı kullanarak client'ı yapılandır
                $this->client->setAccessToken($user->google_calendar_token);
                
                // Token'ı geçersiz kıl
                if ($this->client->getAccessToken()) {
                    $this->client->revokeToken();
                }
            }

            // Kullanıcı bilgilerini temizle
            $user->google_calendar_token = null;
            $user->google_calendar_id = null;
            $user->google_calendar_connected_at = null;
            $user->save();

            return redirect()->route('customer-works.index')
                ->with('success', 'Google Calendar bağlantısı başarıyla kaldırıldı.');

        } catch (\Exception $e) {
            report($e);
            return redirect()->route('customer-works.index')
                ->with('error', 'Google Calendar bağlantısı kaldırılırken bir hata oluştu.');
        }
    }
} 