<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * Responsibilities:
     * - Ensure the request is made by an authenticated user
     * - Ensure the authenticated user has admin privileges
     * - Block access with HTTP 403 if the user is not an admin
     *
     * This middleware is intended to protect admin-only routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Retrieve the currently authenticated user.
         */
        $user = $request->user();

        /**
         * Deny access if:
         * - No authenticated user exists
         * - The authenticated user is not an admin
         */
        abort_if(
            ! $user || ! $user->isAdmin(),
            403,
            'You dont have access.'
        );

        /**
         * Allow the request to proceed.
         */
        return $next($request);
    }
}
