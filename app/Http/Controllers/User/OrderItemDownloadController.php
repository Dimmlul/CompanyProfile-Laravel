<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class OrderItemDownloadController extends Controller
{
    /**
     * Handle product download for a specific order item.
     *
     * Access rules:
     * - The order must belong to the authenticated user
     * - The order item must belong to the specified order
     * - The order must be fully paid
     *
     * Delivery types:
     * - File-based delivery: serve a downloadable file securely
     * - Link-based delivery: redirect to an external download URL
     *
     * Responsibilities:
     * - Enforce strict ownership and payment validation
     * - Validate product delivery configuration
     * - Handle file or link delivery accordingly
     * - Provide graceful fallback errors when delivery is unavailable
     */
    public function download(Order $order, OrderItem $item)
    {
        /**
         * Security checks:
         * - Ensure the order belongs to the authenticated user
         * - Ensure the order item belongs to the order
         * - Ensure the order has been paid
         */
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if($item->order_id !== $order->id, 403);
        abort_if($order->payment_status !== 'paid', 403);

        $product = $item->product;

        /**
         * Fallback: product has no delivery configuration.
         */
        if (! $product->delivery_type) {
            return back()->with('error', 'Download not available.');
        }

        /**
         * File-based delivery.
         * Serve the product file securely from storage.
         */
        if ($product->delivery_type === 'file') {

            /**
             * Ensure the file exists before attempting download.
             */
            if (
                ! $product->download_path ||
                ! Storage::disk('public')->exists($product->download_path)
            ) {
                return back()->with(
                    'error',
                    'File is temporarily unavailable. Please contact support.'
                );
            }

            return Response::download(
                Storage::disk('public')->path($product->download_path)
            );
        }

        /**
         * Link-based delivery.
         * Redirect the user to an external download URL.
         */
        if ($product->delivery_type === 'link') {

            /**
             * Ensure the download URL exists.
             */
            if (! $product->download_url) {
                return back()->with(
                    'error',
                    'Download link is not available yet.'
                );
            }

            return redirect()->away($product->download_url);
        }

        /**
         * Fallback for unsupported delivery types.
         */
        return back()->with('error', 'Invalid delivery type.');
    }
}
