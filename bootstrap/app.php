<?php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // TRUST PROXIES (ngrok)
        $middleware->trustProxies(
            at: \App\Http\Middleware\TrustProxies::class
        );

        // CSRF EXCEPTION
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback',
        ]);

        //  ROUTE MIDDLEWARE
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);
    })


    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
