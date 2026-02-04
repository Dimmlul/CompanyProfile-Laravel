@extends('layouts.app')

@section('title','Checkout')

@section('content')
<section class="py-20 bg-app-bg">
    <div class="mx-auto max-w-3xl px-6">

        {{-- STEP INDICATOR --}}
        <div class="mb-10 flex items-center justify-center gap-6 text-sm">
            <div class="flex items-center gap-2 text-indigo-400">
                <span class="h-7 w-7 rounded-full bg-indigo-500/20 flex items-center justify-center font-semibold">
                    1
                </span>
                Cart
            </div>

            <div class="h-px w-10 bg-white/10"></div>

            <div class="flex items-center gap-2 text-white font-medium">
                <span class="h-7 w-7 rounded-full bg-indigo-500 flex items-center justify-center font-semibold">
                    2
                </span>
                Checkout
            </div>

            <div class="h-px w-10 bg-white/10"></div>

            <div class="flex items-center gap-2 text-app-muted">
                <span class="h-7 w-7 rounded-full bg-white/10 flex items-center justify-center">
                    3
                </span>
                Payment
            </div>
        </div>

        {{-- PAGE TITLE --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-semibold text-white">
                Review & Confirm
            </h1>
            <p class="mt-2 text-sm text-app-muted">
                Please review your order before proceeding to payment
            </p>
        </div>

        {{-- ORDER SUMMARY (COMPACT, NOT TABLE) --}}
        <div class="bg-card border border-card-border rounded-2xl p-6 space-y-4">

            <h2 class="text-sm font-semibold uppercase tracking-wider text-app-muted">
                Order Summary
            </h2>

            @foreach ($carts as $cart)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white font-medium">
                            {{ $cart->product->name }}
                        </p>
                        <p class="text-xs text-app-muted">
                            Qty {{ $cart->qty }}
                        </p>
                    </div>

                    <p class="text-white font-medium">
                        Rp {{ number_format($cart->product->price * $cart->qty) }}
                    </p>
                </div>
            @endforeach

            <div class="border-t border-card-border pt-4 space-y-2 text-sm">
                <div class="flex justify-between text-app-muted">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($total) }}</span>
                </div>
                <div class="flex justify-between text-app-muted">
                    <span>Tax</span>
                    <span>Included</span>
                </div>
                <div class="flex justify-between text-white font-semibold text-base pt-2">
                    <span>Total</span>
                    <span>Rp {{ number_format($total) }}</span>
                </div>
            </div>
        </div>

        {{-- FINAL ACTION --}}
        <form
            method="POST"
            action="{{ route('checkout.process') }}"
            class="mt-8"
        >
            @csrf

            <button
                class="group w-full py-4 rounded-2xl
                       bg-indigo-500 text-white
                       font-semibold text-lg
                       transition-all
                       hover:bg-indigo-600
                       active:scale-[0.98]"
            >
                <span class="flex items-center justify-center gap-3">
                    Proceed to Secure Payment
                    <svg class="h-5 w-5 transition-transform group-hover:translate-x-1"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </span>
            </button>

            <p class="mt-4 text-center text-xs text-app-muted">
                Secure checkout powered by Midtrans
            </p>
        </form>

        {{-- BACK --}}
        <div class="mt-6 text-center">
            <a
                href="{{ route('cart.index') }}"
                class="text-sm text-indigo-400 hover:underline"
            >
                ← Back to Cart
            </a>
        </div>

    </div>
</section>
@endsection
