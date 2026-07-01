@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-6xl px-6">

        <h1 class="mb-8 text-3xl font-semibold text-app-heading">
            Shopping Cart
            <span class="ml-1 text-base font-medium text-app-muted">({{ $carts->count() }})</span>
        </h1>

        @if (session('success'))
            <div class="mb-6 rounded-xl border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-600 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        @if ($carts->isEmpty())
            <x-empty-state
                icon="M3 3h2l.6 3M7 13h10l4-8H5.6M7 13L5.8 18a1 1 0 001 1h10a1 1 0 001-1l-1.2-5M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"
                title="Your cart is empty"
                description="Browse our products and add something you like.">
                <a href="{{ route('products') }}" class="btn-primary btn-sm">Browse products</a>
            </x-empty-state>
        @else
            <div class="flex flex-col gap-10 lg:flex-row">

                {{-- ITEMS --}}
                <div class="flex-1 space-y-4">
                    @foreach ($carts as $cart)
                        <div class="surface flex flex-col gap-4 rounded-2xl p-4 sm:flex-row sm:items-center sm:p-5">
                            {{-- product --}}
                            <a href="{{ route('products.show', $cart->product) }}" class="flex flex-1 items-center gap-4">
                                <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl border border-app-border bg-app-surface-2">
                                    <img src="{{ asset('storage/'.$cart->product->image) }}" alt="{{ $cart->product->name }}"
                                         class="h-full w-full object-cover">
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate font-medium text-app-heading">{{ $cart->product->name }}</p>
                                    <p class="mt-0.5 text-sm text-app-muted">Rp {{ number_format($cart->product->price) }}</p>
                                </div>
                            </a>

                            {{-- qty + subtotal + remove --}}
                            <div class="flex items-center justify-between gap-4 sm:justify-end">
                                <div class="inline-flex items-center rounded-lg border border-app-border">
                                    <form method="POST" action="{{ route('cart.update', $cart) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="qty" value="{{ max(1, $cart->qty - 1) }}">
                                        <button type="submit" class="px-3 py-1.5 text-app-muted transition hover:text-app-heading disabled:opacity-40"
                                                @disabled($cart->qty <= 1)>&minus;</button>
                                    </form>
                                    <span class="min-w-[2.5rem] text-center text-sm font-medium text-app-heading">{{ $cart->qty }}</span>
                                    <form method="POST" action="{{ route('cart.update', $cart) }}">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="qty" value="{{ $cart->qty + 1 }}">
                                        <button type="submit" class="px-3 py-1.5 text-app-muted transition hover:text-app-heading">+</button>
                                    </form>
                                </div>

                                <p class="w-28 text-right font-semibold text-app-heading">
                                    Rp {{ number_format($cart->product->price * $cart->qty) }}
                                </p>

                                <form method="POST" action="{{ route('cart.destroy', $cart) }}">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-app-muted transition hover:text-danger" title="Remove">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2m-7 0l.5 12a1 1 0 001 1h5a1 1 0 001-1L17 7"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <a href="{{ route('products') }}" class="inline-flex items-center gap-2 pt-2 text-sm font-medium text-brand-accent transition hover:opacity-80">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Continue shopping
                    </a>
                </div>

                {{-- SUMMARY --}}
                <div class="w-full lg:max-w-sm">
                    <div class="surface rounded-2xl p-6 lg:sticky lg:top-24">
                        <h2 class="mb-6 text-lg font-semibold text-app-heading">Order summary</h2>

                        <div class="space-y-3 text-sm text-app-muted">
                            <div class="flex justify-between"><span>Subtotal</span><span>Rp {{ number_format($subtotal) }}</span></div>
                            <div class="flex justify-between"><span>Shipping</span><span class="text-green-600 dark:text-green-400">Free</span></div>
                            <div class="flex justify-between"><span>Tax</span><span>Included</span></div>
                        </div>

                        <div class="my-6 border-t border-app-border"></div>

                        <div class="flex justify-between text-lg font-semibold text-app-heading">
                            <span>Total</span>
                            <span>Rp {{ number_format($subtotal) }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn-primary mt-6 w-full py-3.5">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
