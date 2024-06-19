<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // if (isset($_SERVER['HTTP_X_ORIGINAL_HOST'])) {
        //     $url = 'https://' . $_SERVER['HTTP_X_ORIGINAL_HOST'];
        //     URL::forceRootUrl($url);
        //     if (str_contains($url, 'ngrok.io')) {
        //         URL::forceScheme('https');
        //     }
        // }
    }
}
