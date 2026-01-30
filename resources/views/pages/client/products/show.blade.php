@extends('layouts.app')

@section('title', $product->name)

@section('content')

<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-6xl px-6">

        {{-- BREADCRUMB --}}
        <div class="mb-8">
            <p class="text-sm text-app-muted">
                <a href="{{ route('home') }}" class="hover:text-indigo-400 transition">Home</a>
                /
                <a href="{{ route('products') }}" class="hover:text-indigo-400 transition">Products</a>
                /
                <span class="text-indigo-400">{{ $product->name }}</span>
            </p>

            {{-- BACK TO PRODUCTS --}}
            <a href="{{ route('products') }}"
               class="inline-flex items-center gap-2 mt-2
                      text-sm text-app-muted
                      hover:text-indigo-400 transition">
                ← Back to Products
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-16">

            {{-- IMAGE (SINGLE IMAGE) --}}
            <div class="w-full md:w-1/2">
                <div
                    class="relative overflow-hidden rounded-2xl
                           border border-card-border
                           bg-card shadow-lg"
                >
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover
                               transition-transform duration-500
                               hover:scale-105"
                    >
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="w-full md:w-1/2 text-sm">

                {{-- TITLE --}}
                <h1 class="text-3xl font-semibold text-app-text">
                    {{ $product->name }}
                </h1>

                {{-- EXCERPT --}}
                @if ($product->excerpt)
                    <p class="mt-2 text-app-muted">
                        {{ $product->excerpt }}
                    </p>
                @endif

                {{-- PRICE --}}
                <div class="mt-6">
                    <p class="text-2xl font-semibold text-app-text">
                        Rp {{ number_format($product->price) }}
                    </p>
                    <span class="text-xs text-app-muted">
                        Inclusive of all taxes
                    </span>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mt-6">
                    <p class="text-base font-medium text-app-text mb-2">
                        About Product
                    </p>
                    <div class="text-app-muted leading-relaxed text-sm">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-4 mt-10">

                    {{-- ADD TO CART --}}
                    <form method="POST" action="{{ route('cart.store') }}" class="w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <button
                            type="submit"
                            class="w-full py-3.5 rounded-xl
                                border border-card-border
                                bg-white/5
                                text-app-text font-medium
                                hover:bg-white/10 transition">
                            Add to Cart
                        </button>
                    </form>


                    {{-- BUY NOW --}}
                <form method="POST" action="{{ route('cart.buyNow') }}" class="w-full">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <button
                        type="submit"
                        class="w-full text-center py-3.5 rounded-xl
                            bg-indigo-500
                            text-white font-medium
                            hover:bg-indigo-600 transition">
                        Buy Now
                    </button>
                </form>


                </div>

            </div>
        </div>

    </div>
</section>

@endsection
