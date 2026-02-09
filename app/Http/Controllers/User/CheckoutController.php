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

            // CREATE ORDER
            $order = Order::create([
                'user_id'        => $user->id,
                'customer_email' => $request->email,
                'order_number'   => 'ORD-' . now()->format('ymdHis') . '-' . $user->id,
                'total'          => (int) $total,
                'payment_status' => 'pending',
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $cart->product_id,
                    'price'      => (int) $cart->product->price,
                    'qty'        => $cart->qty,
                ]);
            }

            // MIDTRANS CONFIG (BENAR)
            Config::$serverKey    = config('services.midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

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

            $snapToken = Snap::getSnapToken($params);

            if (! $snapToken) {
                throw new \Exception('Failed to get Snap token');
            }

            $order->update([
                'payment_token' => $snapToken,
            ]);

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('checkout.payment', [
                'order' => $order->order_number
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    // 🔥 INI FIX UTAMA SNAP
    public function payment(string $order)
    {
        $order = Order::where('order_number', $order)->firstOrFail();

        abort_if($order->user_id !== Auth::id(), 403);

        if (! $order->payment_token) {
            abort(500, 'Snap token missing');
        }

        return view('pages.user.checkout.payment', compact('order'));
    }
}
