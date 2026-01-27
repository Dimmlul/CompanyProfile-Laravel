<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Client;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        return view('pages.admin.dashboard.index', [
            'totalArticles' => Article::count(),
            'publishedArticles' => Article::where('is_published', true)->count(),

            'totalProducts' => Product::count(),
            'activeProducts' => Product::where('is_active', true)->count(),

            'totalEvents' => Event::count(),
            'activeEvents' => Event::where('is_active', true)->count(),

            'totalGalleries' => Gallery::count(),
            'totalClients' => Client::count(),
        ]);
    }
}
