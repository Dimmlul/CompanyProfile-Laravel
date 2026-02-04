<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Client;
use App\Models\CompanyProfile;

class HomeController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('order')
            ->limit(4)
            ->get();

        $products = Product::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();

        $clients = Client::where('is_active', true)
            ->orderBy('order')
            ->limit(8)
            ->get();

        $companyProfile = CompanyProfile::first();

        return view('pages.client.home.index', compact(
            'galleries',
            'products',
            'clients',
            'companyProfile'
        ));
    }
}
