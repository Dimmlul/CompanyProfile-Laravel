<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Product;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        abort_if(!$user?->isAdmin(), 403);


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
