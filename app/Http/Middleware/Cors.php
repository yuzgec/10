<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // İsteği bir sonraki middleware veya işlem kuyruğuna yönlendir
        $response = $next($request);

        // İzin verilen CORS ayarlarını ekle
        $response->headers->set('Access-Control-Allow-Origin', '*'); // İzin verilen domain (tüm domainler için '*')
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS'); // İzin verilen HTTP metodları
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With'); // İzin verilen başlıklar

        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Content-Security-Policy', "script-src 'self';");
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Eğer OPTIONS metodu kullanılıyorsa (preflight request), sadece başlıkları döndür
        if ($request->getMethod() === "OPTIONS") {
            $response->setStatusCode(200);
        }

        return $response;
    }
}