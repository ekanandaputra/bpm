<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register SetLocale middleware into 'web' group so session is available
        try {
            $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\SetLocale::class);
        } catch (\Throwable $e) {
            // ignore in console or if router not available
        }
    }
}
