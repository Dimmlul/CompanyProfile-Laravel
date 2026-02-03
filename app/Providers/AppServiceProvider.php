<?php

namespace App\Providers;

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
        });

        if (app()->environment('production')) {
        URL::forceScheme('https');
    }
    }
}
