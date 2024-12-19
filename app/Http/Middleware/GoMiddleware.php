<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GoMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Gate::allows('access-go')) {
            abort(403, 'Bu sayfaya erişim izniniz yok.');
        }

        return $next($request);
    }
}
