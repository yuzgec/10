<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class AnalysisController extends Controller
{
    private function normalizeUrl($url)
    {
        // URL'yi normalize et
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }
        
        // URL'yi parse et
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];
        
        // www. kontrolü
        if (!preg_match('/^www\./i', $host)) {
            $host = 'www.' . $host;
        }
        
        // Temiz URL oluştur
        return $parsedUrl['scheme'] . '://' . $host . 
               (isset($parsedUrl['path']) ? $parsedUrl['path'] : '') .
               (isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ], [
            'url.required' => 'Site adresi gereklidir.',
            'url.url' => 'Geçerli bir site adresi giriniz.',
        ]);

        try {
            $normalizedUrl = $this->normalizeUrl($request->url);
            $folderName = $this->createFolderNameFromUrl($normalizedUrl);
            
            // Son 20 kaydı kontrol et
            $existingAnalysis = Analysis::latest()
                ->take(20)
                ->where('folder_name', $folderName)
                ->first();

            if ($existingAnalysis) {
                return redirect()->back()
                               ->with('info', 'Bu site için analiz zaten yapılıyor. En kısa sürede sizinle iletişime geçeceğiz.');
            }

            // Analiz kaydı oluştur
            $analysis = Analysis::create([
                'name' => $request->url,
                'normalized_url' => $normalizedUrl,
                'folder_name' => $folderName,
                'ip' => $request->ip(),
            ]);

            // Klasör oluştur
            Storage::makeDirectory('public/analysis/' . $folderName);

            // Screenshot işlemleri
            Browsershot::url($normalizedUrl)
                ->windowSize(1920, 1080)
                ->waitUntilNetworkIdle()
                ->save(storage_path('app/public/analysis/' . $folderName . '/desktop.jpg'));

            Browsershot::url($normalizedUrl)
                ->device('iPhone X')
                ->waitUntilNetworkIdle()
                ->save(storage_path('app/public/analysis/' . $folderName . '/mobile.jpg'));

            // Resim yollarını kaydet
            $analysis->update([
                'desktop_image' => 'analysis/' . $folderName . '/desktop.jpg',
                'mobile_image' => 'analysis/' . $folderName . '/mobile.jpg',
            ]);

            return redirect()->route('home')
                           ->with('success', 'Site analizi başarıyla tamamlandı. En kısa sürede sizinle iletişime geçeceğiz.');

        } catch (\Exception $e) {
            return redirect()->route('home')
                           ->with('error', 'Site analizi sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }

    private function createFolderNameFromUrl($url)
    {
        // URL'den domain adını al
        $parsedUrl = parse_url($url);
        $domain = $parsedUrl['host'];
        
        // www. ve diğer gereksiz kısımları temizle
        $domain = preg_replace('/^www\./', '', $domain);
        
        // Sadece domain adını al (örn: google.com)
        $parts = explode('.', $domain);
        if (count($parts) > 2) {
            array_shift($parts); // Subdomain'i kaldır
        }
        $cleanDomain = implode('.', $parts);
        
        // Güvenli bir klasör adı oluştur
        return strtolower(preg_replace('/[^a-zA-Z0-9.]/', '', $cleanDomain));
    }

    public function show($id)
    {
        $analysis = Analysis::findOrFail($id);

        dd($analysis);
        return view('frontend.page.analysis', compact('analysis'));
    }
} 