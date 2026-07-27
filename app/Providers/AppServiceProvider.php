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
         * Falls back to an empty (unsaved) instance instead of null, so every
         * view can safely do $companyProfile->field on a brand-new install
         * (before the admin has ever saved the company profile) without a
         * "Attempt to read property on null" error.
         */
        $view->with(
            'companyProfile',
            CompanyProfile::first() ?? new CompanyProfile()
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
         * Counts threads that still need admin attention: either the very
         * first message of a brand-new conversation hasn't been opened yet,
         * or the thread has unread follow-up replies. (Previously this only
         * counted unread replies, so a fresh chat with no reply yet never
         * triggered the badge.)
         */
        if (Auth::check() && Auth::user()->isAdmin()) {
            $unreadInboxCount = Message::whereNull('parent_id')
                ->where(function ($q) {
                    $q->where(function ($root) {
                            $root->whereIn('sender', ['user', 'client'])
                                 ->where('is_read', false);
                        })
                        ->orWhereHas('replies', function ($reply) {
                            $reply->whereIn('sender', ['user', 'client'])
                                  ->where('is_read', false);
                        });
                })
                ->count();

            $view->with('unreadInboxCount', $unreadInboxCount);
        }
    });

    /**
     * Force HTTPS only when the app is actually reachable over HTTPS
     * (production, or local tunneled through ngrok). Forcing it while
     * serving plain local HTTP breaks every generated link/asset URL,
     * since there's no TLS listener to answer them.
     */
    if (str_starts_with(config('app.url'), 'https://')) {
        URL::forceScheme('https');
    }
}

}
