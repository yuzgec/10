<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $path = trim($request->path(), '/');
        
        // /go/ ile başlayan URL'ler için cache oluşturma
        if (str_starts_with($path, 'go/') || str_starts_with($path, 'go')) {
            $redirect = Redirect::active()->where('from_url', $path)->first();
            
            if ($redirect) {
                return redirect($redirect->to_url, $redirect->status_code);
            }
            
            return $next($request);
        }
        
        // Diğer URL'ler için normal cache işlemi
        $redirect = Cache::remember('redirect_' . $path, 3600, function () use ($path) {
            return Redirect::active()->where('from_url', $path)->first();
        });

        if ($redirect) {
            return redirect($redirect->to_url, $redirect->status_code);
        }

        return $next($request);
    }
} 