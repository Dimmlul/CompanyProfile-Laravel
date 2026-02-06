<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        abort_if($carts->isEmpty(), 404);

        $total = $carts->sum(fn ($cart) =>
            $cart->product->price * $cart->qty
        );

        return view('pages.user.checkout.index', compact('carts', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();

            $carts = Cart::with('product')
                ->where('user_id', $user->id)
                ->get();

            if ($carts->isEmpty()) {
                throw new \Exception('Cart empty');
            }

            $total = $carts->sum(fn ($cart) =>
                $cart->product->price * $cart->qty
            );

            // 1️⃣ CREATE ORDER
            $order = Order::create([
                'user_id'        => $user->id,
                'customer_email' => $request->email,
                'order_number'   => 'ORDER-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'total'          => (int) $total,
                'payment_status' => 'pending',
            ]);

            // 2️⃣ ORDER ITEMS
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $cart->product_id,
                    'price'      => (int) $cart->product->price,
                    'qty'        => $cart->qty,
                ]);
            }

            // 3️⃣ MIDTRANS CONFIG
            Config::$serverKey    = config('midtrans.server_key');
            Config::$isProduction = false; // SANDBOX
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            // 4️⃣ PARAMS
            $params = [
                'transaction_details' => [
                    'order_id'     => $order->order_number,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email'      => $order->customer_email,
                ],
            ];

            // 5️⃣ SNAP TOKEN
            $snapToken = Snap::getSnapToken($params);

            if (! $snapToken) {
                throw new \Exception('Failed to get Snap token');
            }

            $order->update([
                'payment_token' => $snapToken,
            ]);

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // ⛔ INI FIX 404 KAMU
            return redirect()->route('checkout.payment', [
                'order' => $order->order_number
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function payment(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        if ($order->payment_status !== 'pending') {
            return redirect()->route('orders.index');
        }

        return view('pages.user.checkout.payment', compact('order'));
    }
}
