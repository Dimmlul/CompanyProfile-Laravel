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
     * List user orders
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
     * Show order detail
     */
    public function show(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load('items.product');

        return view('pages.user.orders.show', compact('order'));
    }

    /**
     * Download product file (ONLY PAID + OWNER)
     */
    public function download(Order $order, OrderItem $item)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        abort_if($item->order_id !== $order->id, 403);
        abort_if($order->payment_status !== 'paid', 403);

        $product = $item->product;

        abort_if($product->delivery_type !== 'file', 403);
        abort_if(! $product->download_path, 404);

        return response()->download(Storage::disk('public')->path($product->download_path));
    }
}
