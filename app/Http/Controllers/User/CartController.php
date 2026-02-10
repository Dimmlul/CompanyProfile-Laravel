<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's shopping cart.
     *
     * Responsibilities:
     * - Retrieve all cart items for the authenticated user
     * - Load related product data
     * - Calculate the cart subtotal
     * - Render the cart page
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        /**
         * Calculate cart subtotal based on product price and quantity.
         */
        $subtotal = $carts->sum(fn ($item) =>
            $item->product->price * $item->qty
        );

        return view('pages.user.cart.index', compact('carts', 'subtotal'));
    }

    /**
     * Add a product to the user's cart.
     *
     * Responsibilities:
     * - Validate the product ID
     * - Increment quantity if the product already exists in the cart
     * - Create a new cart item if it does not exist
     * - Redirect the user back to the cart page
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        /**
         * If the product already exists in the cart,
         * increment its quantity. Otherwise, create a new cart item.
         */
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

    /**
     * Update the quantity of a cart item.
     *
     * Responsibilities:
     * - Ensure the cart item belongs to the authenticated user
     * - Validate the new quantity
     * - Update the cart item quantity
     */
    public function update(Request $request, Cart $cart)
    {
        /**
         * Prevent users from modifying other users' cart items.
         */
        abort_if($cart->user_id !== Auth::id(), 403);

        $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $cart->update([
            'qty' => $request->qty,
        ]);

        return back()->with('success', 'Cart updated');
    }

    /**
     * Remove an item from the user's cart.
     *
     * Responsibilities:
     * - Ensure the cart item belongs to the authenticated user
     * - Delete the cart item
     */
    public function destroy(Cart $cart)
    {
        /**
         * Prevent users from deleting other users' cart items.
         */
        abort_if($cart->user_id !== Auth::id(), 403);

        $cart->delete();

        return back()->with('success', 'Item removed');
    }

    /**
     * Add a product to the cart and immediately proceed to checkout.
     *
     * Responsibilities:
     * - Validate the product ID
     * - Create or update the cart item with a quantity of 1
     * - Redirect the user to the checkout page
     */
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
                'qty' => 1,
            ]
        );

        return redirect()->route('checkout.index');
    }

    /**
     * Display the payment page for a specific order.
     *
     * Responsibilities:
     * - Ensure the order belongs to the authenticated user
     * - Render the payment page for the selected order
     */
    public function payment(Order $order)
    {
        /**
         * Prevent users from accessing other users' orders.
         */
        abort_if($order->user_id !== Auth::id(), 403);

        return view('pages.user.checkout.payment', compact('order'));
    }
}
