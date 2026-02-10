<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a paginated list of orders.
     *
     * Responsibilities:
     * - Ensure the authenticated user has admin privileges
     * - Retrieve orders with related items and products
     * - Include customer (user) information
     * - Apply pagination
     * - Render the admin orders index page
     */
    public function index()
    {
        /**
         * Restrict access to admin users only.
         */
        abort_if(!Auth::user()?->isAdmin(), 403);

        /**
         * Retrieve orders with related order items and products.
         * Orders are sorted by latest first.
         */
        $orders = Order::with(['items.product', 'user'])
            ->latest()
            ->paginate(20);

        return view('pages.admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order details.
     *
     * Responsibilities:
     * - Ensure the authenticated user has admin privileges
     * - Load related order items, products, and customer data
     * - Render the admin order detail page
     */
    public function show(Order $order)
    {
        /**
         * Restrict access to admin users only.
         */
        abort_if(!Auth::user()?->isAdmin(), 403);

        /**
         * Eager-load related order items, products, and user information.
         */
        $order->load('items.product', 'user');

        return view('pages.admin.orders.show', compact('order'));
    }
}
