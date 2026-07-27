<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends Controller
{
    /**
     * Display a list of orders belonging to the authenticated user.
     *
     * Responsibilities:
     * - Retrieve all orders owned by the authenticated user
     * - Eager-load related order items and products
     * - Sort orders by latest first
     * - Render the user orders index page
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('pages.user.orders.index', compact('orders'));
    }

    /**
     * Display detailed information for a specific order.
     *
     * Responsibilities:
     * - Ensure the order belongs to the authenticated user
     * - Load related order items and products
     * - Render the user order detail page
     */
    public function show(Order $order)
    {
        /**
         * Prevent users from accessing orders that do not belong to them.
         */
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load('items.product');

        return view('pages.user.orders.show', compact('order'));
    }

    /**
     * Download a purchased product file.
     *
     * Access rules:
     * - The order must belong to the authenticated user
     * - The order item must belong to the specified order
     * - The order must be fully paid
     * - The product must use file-based delivery
     * - The downloadable file must exist
     *
     * Responsibilities:
     * - Enforce ownership and payment validation
     * - Serve the downloadable product file securely
     */
    public function download(Order $order, OrderItem $item)
    {
        /**
         * Ensure the order belongs to the authenticated user.
         */
        abort_if($order->user_id !== Auth::id(), 403);

        /**
         * Ensure the order item belongs to the specified order.
         */
        abort_if($item->order_id !== $order->id, 403);

        /**
         * Ensure the order has been paid.
         */
        abort_if($order->payment_status !== 'paid', 403);

        $product = $item->product;

        /**
         * Link-based delivery: redirect the buyer to the external URL
         * (kept behind this gated route so the URL is never exposed unpaid).
         */
        if ($product->delivery_type === 'link') {
            abort_if(! $product->download_url, 404);

            return redirect()->away($product->download_url);
        }

        /**
         * Ensure the product uses file-based delivery.
         */
        abort_if($product->delivery_type !== 'file', 403);

        /**
         * Ensure the downloadable file exists.
         */
        abort_if(! $product->download_path, 404);

        /**
         * Serve from the private disk first; fall back to the public disk
         * for files uploaded before private storage was introduced.
         */
        $disk = Storage::disk('local')->exists($product->download_path) ? 'local' : 'public';

        abort_if(! Storage::disk($disk)->exists($product->download_path), 404);

        return response()->download(
            Storage::disk($disk)->path($product->download_path)
        );
    }
}
