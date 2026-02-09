<?php

namespace App\Providers;
use App\Models\Message;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('companyProfile', CompanyProfile::first());
                        $view->with(
                'unreadMessages',
                Message::where('is_read', false)->count()
            );
        });

        if (app()->environment('production','local')) {
        URL::forceScheme('https');
    }
    
    }
}
