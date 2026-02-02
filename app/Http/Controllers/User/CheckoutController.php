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
    /**
     * Show checkout page
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = $carts->sum(fn ($cart) =>
            $cart->product->price * $cart->qty
        );

        return view('pages.user.checkout.index', compact('carts', 'total'));
    }

    /**
     * Process checkout & generate Midtrans snap token
     */
    public function process(Request $request)
    {
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

            // ✅ CREATE ORDER
            $order = Order::create([
                'user_id'        => $user->id,
                'order_number'   => 'ORDER-' . now()->format('YmdHis') . '-' . Str::upper(Str::random(4)),
                'total'          => $total,
                'payment_status' => 'pending',
            ]);

            // ✅ CREATE ORDER ITEMS
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $cart->product_id,
                    'price'      => $cart->product->price,
                    'qty'        => $cart->qty,
                ]);
            }

            // 🔥 MIDTRANS CONFIG
            Config::$serverKey    = config('midtrans.server_key');
            Config::$isProduction = false; // sandbox
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            $params = [
                'transaction_details' => [
                    'order_id'     => $order->order_number,
                    'gross_amount' => (int) $order->total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email'      => $user->email,
                ],
            ];

            // 🔥 GENERATE SNAP TOKEN
            $snapToken = Snap::getSnapToken($params);

            if (!$snapToken) {
                throw new \Exception('Failed to generate Midtrans token');
            }

            // ✅ SAVE TOKEN
            $order->update([
                'payment_token' => $snapToken,
            ]);

            // ✅ CLEAR CART
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('checkout.payment', $order);

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show payment page (Snap)
     */
    public function payment(Order $order)
    {
        // 🔐 pastikan order milik user
        abort_if($order->user_id !== Auth::id(), 403);

        // 🔴 token wajib ada
        if (!$order->payment_token) {
            abort(500, 'Payment token not generated.');
        }

        return view('pages.user.checkout.payment', compact('order'));
    }
}
