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
     * Display the checkout summary page.
     *
     * Responsibilities:
     * - Retrieve all cart items for the authenticated user
     * - Ensure the cart is not empty
     * - Calculate the checkout total
     * - Render the checkout summary page
     */
    public function index()
    {
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        /**
         * Prevent access to checkout when the cart is empty.
         */
        abort_if($carts->isEmpty(), 404);

        /**
         * Calculate the total order amount.
         */
        $total = $carts->sum(fn ($cart) =>
            $cart->product->price * $cart->qty
        );

        return view('pages.user.checkout.index', compact('carts', 'total'));
    }

    /**
     * Process the checkout and initiate payment.
     *
     * Responsibilities:
     * - Validate customer email input
     * - Create an order and order items
     * - Initialize Midtrans Snap payment
     * - Store the Snap payment token
     * - Clear the user's cart after successful order creation
     * - Ensure all operations are executed atomically
     */
    public function process(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        /**
         * Start a database transaction to ensure data consistency.
         */
        DB::beginTransaction();

        try {
            $user = Auth::user();

            /**
             * Retrieve the user's cart items.
             */
            $carts = Cart::with('product')
                ->where('user_id', $user->id)
                ->get();

            if ($carts->isEmpty()) {
                throw new \Exception('Cart empty');
            }

            /**
             * Calculate the total order amount.
             */
            $total = $carts->sum(fn ($cart) =>
                $cart->product->price * $cart->qty
            );

            /**
             * Create a new order record.
             */
            $order = Order::create([
                'user_id'        => $user->id,
                'customer_email' => $request->email,
                'order_number'   => 'ORD-' . now()->format('ymdHis') . '-' . $user->id,
                'total'          => (int) $total,
                'payment_status' => 'pending',
            ]);

            /**
             * Create order items from cart items.
             */
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $cart->product_id,
                    'price'      => (int) $cart->product->price,
                    'qty'        => $cart->qty,
                ]);
            }

            /**
             * Configure Midtrans Snap payment settings.
             */
            Config::$serverKey    = config('services.midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            /**
             * Prepare Midtrans transaction parameters.
             */
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

            /**
             * Request a Snap payment token from Midtrans.
             */
            $snapToken = Snap::getSnapToken($params);

            if (! $snapToken) {
                throw new \Exception('Failed to get Snap token');
            }

            /**
             * Store the Snap payment token in the order record.
             */
            $order->update([
                'payment_token' => $snapToken,
            ]);

            /**
             * Clear the user's cart after successful order creation.
             */
            Cart::where('user_id', $user->id)->delete();

            /**
             * Commit the database transaction.
             */
            DB::commit();

            return redirect()->route('checkout.payment', [
                'order' => $order->order_number
            ]);

        } catch (\Throwable $e) {
            /**
             * Roll back the transaction on any error.
             */
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the payment page for a specific order.
     *
     * Responsibilities:
     * - Retrieve the order by its order number
     * - Ensure the order belongs to the authenticated user
     * - Ensure the Snap payment token exists
     * - Render the payment page
     */
    public function payment(string $order)
    {
        $order = Order::where('order_number', $order)->firstOrFail();

        /**
         * Prevent users from accessing other users' orders.
         */
        abort_if($order->user_id !== Auth::id(), 403);

        /**
         * Ensure the payment token exists before rendering the payment page.
         */
        if (! $order->payment_token) {
            abort(500, 'Snap token missing');
        }

        return view('pages.user.checkout.payment', compact('order'));
    }
}
