<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show checkout page
     */
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        return view('pages.user.checkout.index', compact('carts'));
    }

    /**
     * Process checkout
     */
    public function store(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string'],
        ]);

        DB::transaction(function () use ($request) {

            $carts = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();

            $total = $carts->sum(function ($cart) {
                return $cart->product->price * $cart->quantity;
            });

            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $total,
                'status'  => 'pending',
                'address' => $request->address,
            ]);

            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'product_id'=> $cart->product_id,
                    'price'     => $cart->product->price,
                    'quantity'  => $cart->quantity,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order placed successfully.');
    }
}
