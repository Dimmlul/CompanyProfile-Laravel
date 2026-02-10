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
    public function download(Order $order, OrderItem $item)
    {
        // 🔐 SECURITY CHECK
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if($item->order_id !== $order->id, 403);
        abort_if($order->payment_status !== 'paid', 403);

        $product = $item->product;

        // ❌ NO DELIVERY DATA → FALLBACK
        if (! $product->delivery_type) {
            return back()->with('error', 'Download not available.');
        }

        // 📦 FILE DELIVERY
        if ($product->delivery_type === 'file') {

            if (! $product->download_path ||
                ! Storage::disk('public')->exists($product->download_path)
            ) {
                return back()->with(
                    'error',
                    'File is temporarily unavailable. Please contact support.'
                );
            }

            return Response::download(Storage::disk('public')->path($product->download_path));
        }

        // 🔗 LINK DELIVERY
        if ($product->delivery_type === 'link') {

            if (! $product->download_url) {
                return back()->with(
                    'error',
                    'Download link is not available yet.'
                );
            }

            return redirect()->away($product->download_url);
        }

        // ❓ FALLBACK
        return back()->with('error', 'Invalid delivery type.');
    }
}
