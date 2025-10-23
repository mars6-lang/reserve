<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        // Force HTTPS in production
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // ✅ Share notification state with all Blade views
        View::composer('*', function ($view) {
            $hasUnreadNotifications = false;

            if (Auth::check()) {
                $hasUnreadNotifications = Auth::user()
                    ->notifications()
                    ->whereNull('read_at')
                    ->exists();
            }

            $view->with('hasUnreadNotifications', $hasUnreadNotifications);
        });
    }
}
