<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display active products only.
     */
    public function index()
    {
        $products = Product::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->latest()
            ->get();

        return view('pages.client.products.index', compact('products'));
    }

    /**
     * Show single active product.
     */
    public function show(Product $product)
    {
        abort_if(!$product->is_active, 404);

        return view('pages.client.products.show', compact('product'));
    }
}
