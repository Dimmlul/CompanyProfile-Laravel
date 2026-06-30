@extends('layouts.app')

@section('title', $product->name)

@section('content')

<section class="bg-app-bg py-16">
    <div class="mx-auto max-w-6xl px-6">

        {{-- BREADCRUMB --}}
        <div class="mb-8">
            <p class="text-sm text-app-muted">
                <a href="{{ route('home') }}" class="transition hover:text-brand-accent">Home</a>
                /
                <a href="{{ route('products') }}" class="transition hover:text-brand-accent">Products</a>
                /
                <span class="text-brand-accent">{{ $product->name }}</span>
            </p>

            <a href="{{ route('products') }}"
               class="mt-2 inline-flex items-center gap-2 text-sm text-app-muted transition hover:text-brand-accent">
                &larr; Back to Products
            </a>
        </div>

        <div class="flex flex-col gap-16 md:flex-row">

            {{-- IMAGE --}}
            <div class="w-full md:w-1/2">
                <div class="surface relative overflow-hidden rounded-2xl shadow-lg">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         class="h-full w-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="w-full text-sm md:w-1/2">
                <h1 class="text-3xl font-semibold text-app-heading">{{ $product->name }}</h1>

                @if ($product->excerpt)
                    <p class="mt-2 text-app-muted">{{ $product->excerpt }}</p>
                @endif

                <div class="mt-6">
                    <p class="text-2xl font-semibold text-app-heading">Rp {{ number_format($product->price) }}</p>
                    <span class="text-xs text-app-muted">Inclusive of all taxes</span>
                </div>

                <div class="mt-6">
                    <p class="mb-2 text-base font-medium text-app-heading">About Product</p>
                    <div class="text-sm leading-relaxed text-app-muted">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="mt-10 flex items-center gap-4">
                    <form method="POST" action="{{ route('cart.store') }}" class="w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn-outline w-full py-3.5">Add to Cart</button>
                    </form>

                    <form method="POST" action="{{ route('cart.buyNow') }}" class="w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn-primary w-full py-3.5">Buy Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
