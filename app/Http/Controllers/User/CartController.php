<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $subtotal = $carts->sum(fn ($item) =>
            $item->product->price * $item->qty
        );

        return view('pages.user.cart.index', compact('carts', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->increment('qty');
        } else {
            Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id,
                'qty'        => 1,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Product added to cart');
    }

    public function update(Request $request, Cart $cart)
    {
        abort_if($cart->user_id !== Auth::id(), 403);

        $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $cart->update([
            'qty' => $request->qty,
        ]);

        return back()->with('success', 'Cart updated');
    }

    public function destroy(Cart $cart)
    {
        abort_if($cart->user_id !== Auth::id(), 403);

        $cart->delete();

        return back()->with('success', 'Item removed');
    }

    public function buyNow(Request $request)
    {
    $request->validate([
        'product_id' => ['required', 'exists:products,id'],
    ]);

    Cart::updateOrCreate(
        [
            'user_id'    => Auth::id(),
            'product_id' => $request->product_id,
        ],
        [
            'qty' => DB::raw('qty + 1'),
        ]
    );

    return redirect()
        ->route('cart.index')
        ->with('success', 'Product added to cart.');
}

}
