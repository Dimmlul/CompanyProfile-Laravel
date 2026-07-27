{{-- Checkout step: review the cart summary and enter customer email before moving to payment. --}}
@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="bg-app-bg py-20">
    <div class="mx-auto max-w-3xl px-6">

        {{-- STEP INDICATOR --}}
        <div class="mb-12 flex items-center justify-center gap-6 text-sm">
            <div class="flex items-center gap-2 text-brand-accent">
                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-brand-soft font-semibold">1</span>
                Cart
            </div>
            <div class="h-px w-10 bg-app-border"></div>
            <div class="flex items-center gap-2 font-medium text-app-heading">
                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-brand-main font-semibold text-white">2</span>
                Checkout
            </div>
            <div class="h-px w-10 bg-app-border"></div>
            <div class="flex items-center gap-2 text-app-muted">
                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-app-surface-2">3</span>
                Payment
            </div>
        </div>

        {{-- TITLE --}}
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-semibold text-app-heading">Review &amp; Confirm</h1>
            <p class="mt-2 text-sm text-app-muted">Please review your order before proceeding to payment</p>
        </div>

        {{-- ORDER SUMMARY CARD --}}
        <div class="surface mb-10 space-y-4 rounded-2xl p-6">
            <h2 class="text-xs font-semibold uppercase tracking-wider text-app-muted">Order Summary</h2>

            @foreach ($carts as $cart)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-medium text-app-heading">{{ $cart->product->name }}</p>
                        <p class="text-xs text-app-muted">Qty {{ $cart->qty }}</p>
                    </div>
                    <p class="font-medium text-app-heading">Rp {{ number_format($cart->product->price * $cart->qty, 0, ',', '.') }}</p>
                </div>
            @endforeach

            <div class="space-y-2 border-t border-app-border pt-4 text-sm">
                <div class="flex justify-between text-app-muted">
                    <span>Subtotal</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-base font-semibold text-app-heading">
                    <span>Total</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- CHECKOUT FORM --}}
        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf

            <div class="surface space-y-5 rounded-2xl p-6">
                <h2 class="text-xs font-semibold uppercase tracking-wider text-app-muted">Customer Information</h2>

                <div>
                    <label class="mb-1 block text-sm text-app-muted">Email Address</label>
                    <input type="email" name="email" required
                           value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="you@example.com"
                           class="w-full rounded-xl border border-app-border bg-transparent px-4 py-3 text-sm
                                  text-app-heading placeholder:text-app-muted focus:border-brand-main focus:outline-none">
                    @error('email')
                        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn-primary mt-8 w-full py-4 text-base active:scale-[0.98]">
                Proceed to Secure Payment
            </button>

            <p class="mt-4 text-center text-xs text-app-muted">Secure checkout powered by Midtrans</p>
        </form>

        {{-- BACK --}}
        <div class="mt-6 text-center">
            <a href="{{ route('cart.index') }}" class="text-sm text-brand-accent hover:underline">Back to Cart</a>
        </div>
    </div>
</section>
@endsection
