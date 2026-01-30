@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-6xl px-6">

        <div class="flex flex-col md:flex-row gap-12">

            {{-- ================= LEFT : CART LIST ================= --}}
            <div class="flex-1">

                <h1 class="text-3xl font-semibold text-app-text mb-8">
                    Shopping Cart
                    <span class="text-sm text-indigo-400 font-medium">
                        ({{ $carts->count() }} items)
                    </span>
                </h1>

                {{-- HEADER --}}
                <div class="grid grid-cols-[2fr_1fr_1fr] text-app-muted text-sm font-medium pb-3 border-b border-card-border">
                    <p>Product Details</p>
                    <p class="text-center">Subtotal</p>
                    <p class="text-center">Action</p>
                </div>

                {{-- CART ITEMS --}}
                @forelse ($carts as $cart)
                    <div class="grid grid-cols-[2fr_1fr_1fr] items-center
                                py-5 border-b border-card-border">

                        {{-- PRODUCT --}}
                        <div class="flex items-center gap-5">
                            <div
                                class="w-24 h-24 rounded-xl overflow-hidden
                                       border border-card-border bg-card">
                                <img
                                    src="{{ asset('storage/'.$cart->product->image) }}"
                                    alt="{{ $cart->product->name }}"
                                    class="w-full h-full object-cover">
                            </div>

                            <div>
                                <p class="font-semibold text-app-text">
                                    {{ $cart->product->name }}
                                </p>

                                <div class="text-sm text-app-muted mt-1 space-y-1">
                                    <p>Qty: {{ $cart->qty }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- SUBTOTAL --}}
                        <p class="text-center font-medium text-app-text">
                            Rp {{ number_format($cart->product->price * $cart->qty) }}
                        </p>

                        {{-- ACTION --}}
                        <form
                            method="POST"
                            action="{{ route('cart.destroy', $cart) }}"
                            class="flex justify-center">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-400 hover:text-red-500 transition"
                                title="Remove">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-5 w-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 9v6m3-3H9m9 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </form>

                    </div>
                @empty
                    <p class="text-app-muted mt-8">
                        Your cart is empty.
                    </p>
                @endforelse

                {{-- CONTINUE SHOPPING --}}
                <a href="{{ route('products') }}"
                   class="inline-flex items-center gap-2 mt-8
                          text-indigo-400 font-medium
                          hover:text-indigo-300 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-4 w-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15 19l-7-7 7-7" />
                    </svg>
                    Continue Shopping
                </a>
            </div>

            {{-- ================= RIGHT : ORDER SUMMARY ================= --}}
            <div
                class="w-full md:max-w-sm
                       rounded-2xl
                       border border-card-border
                       bg-card p-6 h-fit">

                <h2 class="text-xl font-semibold text-app-text mb-6">
                    Order Summary
                </h2>

                <div class="space-y-3 text-sm text-app-muted">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal) }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span class="text-green-400">Free</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Tax</span>
                        <span>Included</span>
                    </div>
                </div>

                <div class="border-t border-card-border my-6"></div>

                <div class="flex justify-between text-lg font-semibold text-app-text">
                    <span>Total</span>
                    <span>Rp {{ number_format($subtotal) }}</span>
                </div>

                <a
                    href="{{ route('checkout.index') }}"
                    class="block text-center mt-6
                           py-3.5 rounded-xl
                           bg-indigo-500
                           text-white font-medium
                           hover:bg-indigo-600 transition">
                    Proceed to Checkout
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
