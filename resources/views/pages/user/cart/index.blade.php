@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-6xl px-6">

        <div class="flex flex-col gap-12 md:flex-row">

            {{-- ================= LEFT : CART LIST ================= --}}
            <div class="flex-1">

                <h1 class="mb-8 text-3xl font-semibold text-app-heading">
                    Shopping Cart
                    <span class="text-sm font-medium text-brand-accent">({{ $carts->count() }} items)</span>
                </h1>

                {{-- HEADER --}}
                <div class="grid grid-cols-[2fr_1fr_1fr] border-b border-app-border pb-3 text-sm font-medium text-app-muted">
                    <p>Product Details</p>
                    <p class="text-center">Subtotal</p>
                    <p class="text-center">Action</p>
                </div>

                {{-- CART ITEMS --}}
                @forelse ($carts as $cart)
                    <div class="grid grid-cols-[2fr_1fr_1fr] items-center border-b border-app-border py-5">
                        <div class="flex items-center gap-5">
                            <div class="h-24 w-24 overflow-hidden rounded-xl border border-app-border bg-app-surface-2">
                                <img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->name }}"
                                     class="h-full w-full object-cover">
                            </div>
                            <div>
                                <p class="font-semibold text-app-heading">{{ $cart->product->name }}</p>
                                <div class="mt-1 space-y-1 text-sm text-app-muted">
                                    <p>Qty: {{ $cart->qty }}</p>
                                </div>
                            </div>
                        </div>

                        <p class="text-center font-medium text-app-heading">
                            Rp {{ number_format($cart->product->price * $cart->qty) }}
                        </p>

                        <form method="POST" action="{{ route('cart.destroy', $cart) }}" class="flex justify-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger transition hover:opacity-80" title="Remove">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m9 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="mt-8 text-app-muted">Your cart is empty.</p>
                @endforelse

                <a href="{{ route('products') }}"
                   class="mt-8 inline-flex items-center gap-2 font-medium text-brand-accent transition hover:opacity-80">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Continue Shopping
                </a>
            </div>

            {{-- ================= RIGHT : ORDER SUMMARY ================= --}}
            <div class="surface h-fit w-full rounded-2xl p-6 md:max-w-sm">
                <h2 class="mb-6 text-xl font-semibold text-app-heading">Order Summary</h2>

                <div class="space-y-3 text-sm text-app-muted">
                    <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($subtotal) }}</span></div>
                    <div class="flex justify-between"><span>Shipping</span><span class="text-success">Free</span></div>
                    <div class="flex justify-between"><span>Tax</span><span>Included</span></div>
                </div>

                <div class="my-6 border-t border-app-border"></div>

                <div class="flex justify-between text-lg font-semibold text-app-heading">
                    <span>Total</span>
                    <span>Rp {{ number_format($subtotal) }}</span>
                </div>

                <a href="{{ route('checkout.index') }}" class="btn-primary mt-6 w-full py-3.5">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</section>
@endsection
