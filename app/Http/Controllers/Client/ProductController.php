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

    /**
     * ===============================
     * PRODUCT DETAIL
     * ===============================
     */
    public function show(Product $product)
    {
        // pastikan hanya produk aktif yang bisa diakses
        if (! $product->is_active) {
            abort(404);
        }

        return view(
            'pages.client.products.show',
            compact('product')
        );
    }
}
