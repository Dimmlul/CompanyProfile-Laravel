<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockAdminShopping
{
    /**
     * Admin accounts manage the store — they don't shop in it.
     * Blocks cart/checkout actions so an admin session can never place an order,
     * even if a request is sent directly to the route (not just via the UI).
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_if($request->user()?->isAdmin(), 403, "Admin accounts can't use the shop.");

        return $next($request);
    }
}
