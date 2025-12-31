<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        try {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
        } catch (\Throwable $e) {
            // ignore
        }

        return $next($request);
    }
}
