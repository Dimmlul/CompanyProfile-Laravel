<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // ===============================
        // NEWEST PRODUCTS
        // ===============================
        $newestProducts = Product::query()
            ->where('is_active', true)
            ->latest()
            ->limit(3)
            ->get();

        // ===============================
        // ALL PRODUCTS (PAGINATED)
        // ===============================
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->latest()
            ->paginate(6);

        return view(
            'pages.client.products.index',
            compact('newestProducts', 'products')
        );
    }


}
