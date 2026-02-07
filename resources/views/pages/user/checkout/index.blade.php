@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="py-20 bg-app-bg">
    <div class="mx-auto max-w-3xl px-6">

        {{-- STEP INDICATOR --}}
        <div class="mb-12 flex items-center justify-center gap-6 text-sm">
            <div class="flex items-center gap-2 text-indigo-400">
                <span class="h-7 w-7 rounded-full bg-indigo-500/20 flex items-center justify-center font-semibold">1</span>
                Cart
            </div>

            <div class="h-px w-10 bg-white/10"></div>

            <div class="flex items-center gap-2 text-white font-medium">
                <span class="h-7 w-7 rounded-full bg-indigo-500 flex items-center justify-center font-semibold">2</span>
                Checkout
            </div>

            <div class="h-px w-10 bg-white/10"></div>

            <div class="flex items-center gap-2 text-app-muted">
                <span class="h-7 w-7 rounded-full bg-white/10 flex items-center justify-center">3</span>
                Payment
            </div>
        </div>

        {{-- TITLE --}}
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-semibold text-white">
                Review & Confirm
            </h1>
            <p class="mt-2 text-sm text-app-muted">
                Please review your order before proceeding to payment
            </p>
        </div>

        {{-- ORDER SUMMARY CARD --}}
        <div class="client-card p-6 space-y-4 mb-10">
            <h2 class="text-xs font-semibold uppercase tracking-wider text-app-muted">
                Order Summary
            </h2>

            @foreach ($carts as $cart)
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-white font-medium">
                            {{ $cart->product->name }}
                        </p>
                        <p class="text-xs text-app-muted">
                            Qty {{ $cart->qty }}
                        </p>
                    </div>

                    <p class="text-white font-medium">
                        Rp {{ number_format($cart->product->price * $cart->qty, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach

            <div class="border-t border-white/10 pt-4 space-y-2 text-sm">
                <div class="flex justify-between text-app-muted">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-white font-semibold text-base">
                    <span>Total</span>
                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- CHECKOUT FORM CARD --}}
        <form method="POST" action="{{ route('checkout.process') }}">
            @csrf

            <div class="client-card p-6 space-y-5">
                <h2 class="text-xs font-semibold uppercase tracking-wider text-app-muted">
                    Customer Information
                </h2>

                <div>
                    <label class="block mb-1 text-sm text-app-muted">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        value="{{ old('email', auth()->user()->email ?? '') }}"
                        placeholder="you@example.com"
                        class="client-input w-full rounded-xl px-4 py-3 text-sm"
                    >

                    @error('email')
                        <p class="mt-1 text-xs text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- SUBMIT --}}
            <button
                type="submit"
                class="mt-8 w-full rounded-2xl py-4
                       bg-indigo-500 text-white
                       font-semibold text-lg
                       transition hover:bg-indigo-600 active:scale-[0.98]"
            >
                Proceed to Secure Payment →
            </button>

            <p class="mt-4 text-center text-xs text-app-muted">
                Secure checkout powered by Midtrans
            </p>
        </form>

        {{-- BACK --}}
        <div class="mt-6 text-center">
            <a href="{{ route('cart.index') }}"
               class="text-sm text-indigo-400 hover:underline">
                ← Back to Cart
            </a>
        </div>

    </div>
</section>
@endsection
