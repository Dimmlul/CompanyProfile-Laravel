<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Product;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * Responsibilities:
     * - Ensure the authenticated user has admin privileges
     * - Aggregate key statistics for dashboard widgets
     * - Retrieve recent orders for quick overview
     * - Render the admin dashboard view
     */
    public function index()
    {
        /**
         * Retrieve the currently authenticated user.
         */
        $user = Auth::user();

        /**
         * Prevent non-admin users from accessing the admin dashboard.
         */
        abort_if(!$user?->isAdmin(), 403);

        return view('pages.admin.dashboard.index', [

            /**
             * Article statistics
             */
            'totalArticles' => Article::count(),
            'publishedArticles' => Article::where('is_published', true)->count(),

            /**
             * Product statistics
             */
            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('is_active', true)->count(),

            /**
             * Event statistics
             */
            'totalEvents' => Event::count(),
            'activeEvents' => Event::where('is_active', true)->count(),

            /**
             * Gallery statistics
             * Note: Only active galleries are considered.
             */
            'totalGalleries' => Gallery::count(),
            'activeGalleries' => Gallery::where('is_active', true)->count(),

            /**
             * Client statistics
             */
            'totalClients' => Client::count(),
            'activeClients' => Client::where('is_active', true)->count(),

            /**
             * Recent orders overview
             * - Includes related order items and products
             * - Includes customer (user) information
             * - Limited to the latest 5 orders
             */
            'recentOrders' => Order::with(['items.product', 'user'])
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
