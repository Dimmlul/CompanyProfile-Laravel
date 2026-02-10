<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method is reserved for binding services into
     * the Laravel service container.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Responsibilities:
     * - Share global view data (company profile & unread messages)
     * - Enforce HTTPS scheme in production and local environments
     */
public function boot(): void
{
    View::composer('*', function ($view) {

        /**
         * =============================
         * GLOBAL COMPANY PROFILE
         * =============================
         */
        $view->with(
            'companyProfile',
            CompanyProfile::first()
        );

        /**
         * =============================
         * USER INBOX (FRONTEND)
         * =============================
         */
        if (Auth::check() && !Auth::user()->isAdmin()) {
            $unreadMessages = Message::where('user_id', Auth::id())
                ->whereNull('parent_id')
                ->whereHas('replies', function ($q) {
                    $q->where('sender', 'admin')
                      ->where('is_read', false);
                })
                ->count();

            $view->with('unreadMessages', $unreadMessages);
        }

        /**
         * =============================
         * ADMIN INBOX BADGE (SIDEBAR)
         * =============================
         */
        if (Auth::check() && Auth::user()->isAdmin()) {
            $unreadInboxCount = Message::whereNull('parent_id')
                ->whereHas('replies', function ($q) {
                    $q->whereIn('sender', ['user', 'client'])
                      ->where('is_read', false);
                })
                ->count();

            $view->with('unreadInboxCount', $unreadInboxCount);
        }
    });

    /**
     * Force HTTPS
     */
    if (app()->environment('production', 'local')) {
        URL::forceScheme('https');
    }
}

}
