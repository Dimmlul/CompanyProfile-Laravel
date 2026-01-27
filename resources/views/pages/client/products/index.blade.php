<!-- resources/views/pages/client/products/index.blade.php -->
@extends('layouts.app')

@section('title', 'Products')

@section('content')

<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div class="mb-12 text-center">
            <h1 class="text-3xl font-bold text-app-text">
                Our Products
            </h1>
            <p class="mt-2 text-app-muted">
                Explore our best products and services
            </p>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse ($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="group overflow-hidden rounded-xl
                          border border-card-border bg-card
                          transition hover:shadow-lg">

                    {{-- IMAGE --}}
                    <div class="overflow-hidden">
                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            alt="{{ $product->name }}"
                            class="h-56 w-full object-cover
                                   transition-transform duration-300
                                   group-hover:scale-105"
                        >
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-app-text">
                            {{ $product->name }}
                        </h3>

                        @if ($product->excerpt)
                            <p class="mt-1 text-sm text-app-muted">
                                {{ $product->excerpt }}
                            </p>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold text-app-text">
                                Rp {{ number_format($product->price) }}
                            </span>

                            <span class="text-sm text-app-muted
                                         group-hover:text-app-text transition">
                                View Detail →
                            </span>
                        </div>
                    </div>

                </a>
            @empty
                <div class="col-span-full text-center text-app-muted">
                    No products available.
                </div>
            @endforelse

        </div>

    </div>
</section>

@endsection
