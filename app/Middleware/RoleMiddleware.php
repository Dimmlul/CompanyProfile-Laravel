<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request and enforce role-based access control.
     *
     * Responsibilities:
     * - Ensure the user is authenticated
     * - Ensure the authenticated user has the required role
     * - Abort the request with HTTP 403 if access is not allowed
     *
     * Usage example:
     * Route::middleware('role:admin')->group(function () {
     *     // Admin-only routes
     * });
     */
    public function handle($request, Closure $next, $role)
    {
        /**
         * Deny access if:
         * - The user is not authenticated
         * - The user's role does not match the required role
         */
        if (! Auth::check() || Auth::user()->role !== $role) {
            abort(403);
        }

        /**
         * Allow the request to proceed if authorization passes.
         */
        return $next($request);
    }
}
