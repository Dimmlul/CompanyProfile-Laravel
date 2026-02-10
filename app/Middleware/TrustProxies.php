<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Using '*' means the application will trust all proxies.
     * This is commonly required when the application is deployed
     * behind load balancers, reverse proxies, or services like
     * Nginx, Cloudflare, or container platforms.
     */
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxy information.
     *
     * These headers allow the application to correctly determine:
     * - The original client IP address
     * - The original host
     * - The original port
     * - The original request scheme (HTTP / HTTPS)
     *
     * This configuration ensures proper URL generation,
     * request handling, and security behavior when behind proxies.
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO;
}
