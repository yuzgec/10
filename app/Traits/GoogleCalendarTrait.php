<?php

namespace App\Traits;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Carbon\Carbon;

trait GoogleCalendarTrait
{
    private function getGoogleClient()
    {
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType(config('services.google.access_type'));
        $client->setApprovalPrompt(config('services.google.approval_prompt'));
        $client->setPrompt(config('services.google.prompt'));
        $client->setIncludeGrantedScopes(true);
        
        return $client;
    }

    private function getGoogleCalendarService()
    {
        \Log::debug('getGoogleCalendarService başladı');
        
        $client = $this->getGoogleClient();
        
        if (!auth()->user()->google_calendar_token) {
            \Log::debug('Google Calendar token bulunamadı');
            return null;
        }

        \Log::debug('Token bulundu', [
            'token' => auth()->user()->google_calendar_token
        ]);

        $accessToken = json_decode(auth()->user()->google_calendar_token, true);
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            \Log::debug('Token süresi dolmuş');
            if ($client->getRefreshToken()) {
                \Log::debug('Refresh token ile yeni token alınıyor');
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                auth()->user()->update([
                    'google_calendar_token' => json_encode($client->getAccessToken())
                ]);
                \Log::debug('Yeni token kaydedildi');
            } else {
                \Log::debug('Refresh token bulunamadı');
                return null;
            }
        }

        \Log::debug('Google Calendar service oluşturuluyor', [
            'token_expired' => $client->isAccessTokenExpired() ? 'Evet' : 'Hayır',
            'has_refresh_token' => $client->getRefreshToken() ? 'Evet' : 'Hayır'
        ]);

        return new Google_Service_Calendar($client);
    }

    public function createGoogleCalendarEvent($work)
    {
        try {
            \Log::debug('createGoogleCalendarEvent başladı', [
                'work_id' => $work->id,
                'user_id' => auth()->id(),
                'has_token' => auth()->user()->google_calendar_token ? 'Evet' : 'Hayır',
                'token' => auth()->user()->google_calendar_token
            ]);

            $service = $this->getGoogleCalendarService();
            if (!$service) {
                \Log::error('Google Calendar service alınamadı', [
                    'user_id' => auth()->id(),
                    'token' => auth()->user()->google_calendar_token ? 'var' : 'yok',
                    'token_value' => auth()->user()->google_calendar_token
                ]);
                return null;
            }

            \Log::debug('Event verisi hazırlanıyor', [
                'customer' => $work->customer->company_name,
                'offer' => $work->offer->offer_no,
                'start_date' => $work->start_date,
                'delivery_date' => $work->delivery_date,
                'calendar_id' => auth()->user()->google_calendar_id ?? 'primary'
            ]);

            $event = new Google_Service_Calendar_Event([
                'summary' => $work->customer->company_name . ' - ' . $work->offer->offer_no,
                'description' => "İş Detayı:\n" . 
                    ($work->description ?? 'Açıklama yok') . "\n\n" .
                    "Notlar:\n" . ($work->notes ?? 'Not yok') . "\n\n" .
                    "Toplam Tutar: " . number_format($work->total_amount, 2) . " TL",
                'start' => [
                    'dateTime' => Carbon::parse($work->start_date)->startOfDay()->toRfc3339String(),
                    'timeZone' => config('app.timezone'),
                ],
                'end' => [
                    'dateTime' => Carbon::parse($work->delivery_date)->endOfDay()->toRfc3339String(),
                    'timeZone' => config('app.timezone'),
                ],
                'reminders' => [
                    'useDefault' => false,
                    'overrides' => [
                        ['method' => 'email', 'minutes' => 24 * 60],
                        ['method' => 'popup', 'minutes' => 60],
                    ],
                ],
            ]);

            \Log::debug('Event oluşturma isteği gönderiliyor', [
                'calendar_id' => auth()->user()->google_calendar_id ?? 'primary',
                'event' => $event
            ]);

            $calendarId = auth()->user()->google_calendar_id ?? 'primary';
            $createdEvent = $service->events->insert($calendarId, $event);
            
            if (!$createdEvent || !$createdEvent->getId()) {
                \Log::error('Event ID alınamadı', [
                    'event_response' => $createdEvent,
                    'calendar_id' => $calendarId
                ]);
                return null;
            }

            $eventId = $createdEvent->getId();
            \Log::debug('Event başarıyla oluşturuldu', [
                'event_id' => $eventId,
                'calendar_id' => $calendarId,
                'event_response' => $createdEvent
            ]);

            // Event ID'yi doğrudan kaydet
            $work->google_calendar_event_id = $eventId;
            $work->save();
            
            \Log::debug('Event ID work kaydına eklendi', [
                'work_id' => $work->id,
                'event_id' => $eventId,
                'work_event_id' => $work->google_calendar_event_id
            ]);
            
            return $eventId;

        } catch (\Exception $e) {
            \Log::error('Google Calendar event oluşturma hatası', [
                'work_id' => $work->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'token' => auth()->user()->google_calendar_token,
                'calendar_id' => auth()->user()->google_calendar_id ?? 'primary'
            ]);
            return null;
        }
    }

    public function updateGoogleCalendarEvent($work)
    {
        if (!$work->google_calendar_event_id) return null;

        $service = $this->getGoogleCalendarService();
        if (!$service) return null;

        $event = new Google_Service_Calendar_Event([
            'summary' => $work->customer->company_name . ' - ' . $work->offer->offer_no,
            'description' => $work->description ?? 'İş detayı',
            'start' => [
                'dateTime' => Carbon::parse($work->start_date)->toRfc3339String(),
                'timeZone' => config('app.timezone'),
            ],
            'end' => [
                'dateTime' => Carbon::parse($work->delivery_date)->toRfc3339String(),
                'timeZone' => config('app.timezone'),
            ],
        ]);

        try {
            $calendarId = auth()->user()->google_calendar_id ?? 'primary';
            $event = $service->events->update($calendarId, $work->google_calendar_event_id, $event);
            return $event->getId();
        } catch (\Exception $e) {
            report($e);
            return null;
        }
    }

    public function deleteGoogleCalendarEvent($work)
    {
        if (!$work->google_calendar_event_id) return;

        $service = $this->getGoogleCalendarService();
        if (!$service) return;

        try {
            $calendarId = auth()->user()->google_calendar_id ?? 'primary';
            $service->events->delete($calendarId, $work->google_calendar_event_id);
        } catch (\Exception $e) {
            report($e);
        }
    }
} 