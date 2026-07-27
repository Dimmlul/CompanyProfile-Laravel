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

        // Trust all proxies (dev behind Docker/ngrok); restrict to real proxy IPs in production.
        // Note: `at:` expects proxy IPs — the previous value was a non-existent middleware class name.
        $middleware->trustProxies(at: '*');

        // Baseline security headers (clickjacking / MIME-sniffing protection) on every response.
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);

        // CSRF EXCEPTION
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback',
        ]);

        //  ROUTE MIDDLEWARE
        $middleware->alias([
            'admin'      => \App\Http\Middleware\IsAdmin::class,
            'not-admin'  => \App\Http\Middleware\BlockAdminShopping::class,
        ]);
    })


    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
