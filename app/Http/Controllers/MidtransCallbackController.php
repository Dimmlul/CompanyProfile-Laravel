<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $orderId = str_replace('ORDER-', '', $request->order_id);
        $order = Order::findOrFail($orderId);

        if ($request->transaction_status === 'settlement') {
            $order->update(['status' => 'paid']);
        } elseif (in_array($request->transaction_status, ['expire', 'cancel'])) {
            $order->update(['status' => 'failed']);
        }

        return response()->json(['success' => true]);
    }
}

