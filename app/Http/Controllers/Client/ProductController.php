<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display the client products listing page.
     *
     * Responsibilities:
     * - Retrieve a small set of the newest active products
     * - Retrieve all active products with pagination
     * - Apply ordering for consistent product display
     * - Render the client products index page
     */
    public function index()
    {
        /**
         * ===============================
         * NEWEST PRODUCTS
         *
         * Criteria:
         * - Only active products
         * - Ordered by latest creation date
         * - Limited to a small featured subset
         * ===============================
         */
        $newestProducts = Product::query()
            ->where('is_active', true)
            ->latest()
            ->limit(3)
            ->get();

        /**
         * ===============================
         * ALL PRODUCTS (PAGINATED)
         *
         * Criteria:
         * - Only active products
         * - Ordered by custom display order
         * - Paginated for client-side browsing
         * ===============================
         */
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
     *
     * Display a single product detail page.
     *
     * Responsibilities:
     * - Ensure the product is active and publicly accessible
     * - Render the client product detail page
     */
    public function show(Product $product)
    {
        /**
         * Restrict access to inactive products.
         */
        if (! $product->is_active) {
            abort(404);
        }

        $related = Product::query()
            ->where('is_active', true)
            ->whereKeyNot($product->getKey())
            ->latest()
            ->take(3)
            ->get();

        return view(
            'pages.client.products.show',
            compact('product', 'related')
        );
    }
}
