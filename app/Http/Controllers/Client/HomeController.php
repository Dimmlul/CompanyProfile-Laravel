<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Client;
use App\Models\CompanyProfile;

class HomeController extends Controller
{
    /**
     * Display the client homepage.
     *
     * Responsibilities:
     * - Retrieve a curated subset of active gallery items
     * - Retrieve a curated subset of active products
     * - Retrieve a curated subset of active clients
     * - Retrieve the company profile information
     * - Render the client home page
     */
    public function index()
    {
        /**
         * Retrieve featured gallery items.
         * Only active items are shown and ordered by display order.
         */
        $galleries = Gallery::where('is_active', true)
            ->orderBy('order')
            ->limit(4)
            ->get();

        /**
         * Retrieve featured products.
         * Only active products are shown and ordered by display order.
         */
        $products = Product::where('is_active', true)
            ->orderBy('order')
            ->limit(6)
            ->get();

        /**
         * Retrieve featured clients.
         * Only active clients are shown and ordered by display order.
         */
        $clients = Client::where('is_active', true)
            ->orderBy('order')
            ->limit(8)
            ->get();

        /**
         * Retrieve the company profile.
         * The application uses a single-record company profile pattern.
         */
        $companyProfile = CompanyProfile::first();

        return view('pages.client.home.index', compact(
            'galleries',
            'products',
            'clients',
            'companyProfile'
        ));
    }
}
