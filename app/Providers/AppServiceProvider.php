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
        /**
         * Global view composer.
         *
         * This composer runs for all views and injects:
         * - Company profile data
         * - Unread message count (user-specific or guest fallback)
         */
        View::composer('*', function ($view) {
            /**
             * Share company profile data globally.
             *
             * Used for:
             * - Header branding
             * - Footer information
             * - Public company pages
             */
            $view->with(
                'companyProfile',
                CompanyProfile::first()
            );

            /**
             * Handle unread message count.
             *
             * Behavior:
             * - Authenticated users:
             *   Count root message threads that have unread admin replies
             *
             * - Guests:
             *   Fallback count of unread messages (used defensively)
             */
            if (Auth::check()) {
                $unreadMessages = Message::where('user_id', Auth::id())
                    ->whereNull('parent_id')
                    ->whereHas('replies', function ($q) {
                        $q->where('sender', 'admin')
                          ->where('is_read', false);
                    })
                    ->count();

                $view->with('unreadMessages', $unreadMessages);
            } else {
                $view->with(
                    'unreadMessages',
                    Message::where('is_read', false)->count()
                );
            }
        });

        /**
         * Force HTTPS scheme in production and local environments.
         *
         * This ensures:
         * - Correct asset URLs
         * - Proper URL generation
         * - Compatibility with reverse proxies and HTTPS tunneling
         */
        if (app()->environment('production', 'local')) {
            URL::forceScheme('https');
        }
    }
}
