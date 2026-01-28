@extends('layouts.app')

@section('title', 'Products')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- ================= HEADER ================= --}}
        <div class="mb-20 text-center max-w-2xl mx-auto">
            <h1 class="text-4xl font-semibold text-white">
                Our Products
            </h1>
            <p class="mt-4 text-app-muted leading-relaxed">
                Explore our professional digital products and services
                designed to help your business grow.
            </p>
        </div>

        {{-- ==================================================
        | SECTION 1 — NEWEST PRODUCTS
        ================================================== --}}
        <div class="mb-28">
            <div class="mb-10">
                <h2 class="text-2xl font-semibold text-white">
                    Newest Products
                </h2>
                <p class="mt-2 text-sm text-app-muted">
                    Our latest products and offerings.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($newestProducts as $product)
                    <a href="{{ route('products.show', $product) }}"
                       class="group rounded-2xl border border-white/10 bg-white/5 p-6
                              transition hover:border-indigo-400/40 hover:bg-white/10">

                        @if ($product->image)
                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="mb-5 h-44 w-full rounded-xl object-cover">
                        @endif

                        <h3 class="mb-2 text-lg font-semibold text-white
                                   group-hover:text-indigo-300 transition">
                            {{ $product->name }}
                        </h3>

                        @if ($product->excerpt)
                            <p class="text-sm text-app-muted line-clamp-3">
                                {{ $product->excerpt }}
                            </p>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold text-white">
                                Rp {{ number_format($product->price) }}
                            </span>

                            <span class="inline-flex items-center gap-2
                                         text-sm text-indigo-400 font-medium">
                                View detail →
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-app-muted">
                        No new products available.
                    </p>
                @endforelse
            </div>
        </div>

        {{-- ==================================================
        | SECTION 2 — ALL PRODUCTS
        ================================================== --}}
        <div>
            <div class="mb-10">
                <h2 class="text-2xl font-semibold text-white">
                    All Products
                </h2>
                <p class="mt-2 text-sm text-app-muted">
                    Browse all available products.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($products as $product)
                    <a href="{{ route('products.show', $product) }}"
                       class="group rounded-2xl border border-white/10 bg-white/5 p-6
                              transition hover:border-indigo-400/40 hover:bg-white/10">

                        @if ($product->image)
                            <img
                                src="{{ asset('storage/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="mb-5 h-44 w-full rounded-xl object-cover">
                        @endif

                        <h3 class="mb-2 text-lg font-semibold text-white
                                   group-hover:text-indigo-300 transition">
                            {{ $product->name }}
                        </h3>

                        @if ($product->excerpt)
                            <p class="text-sm text-app-muted line-clamp-3">
                                {{ $product->excerpt }}
                            </p>
                        @endif

                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm font-semibold text-white">
                                Rp {{ number_format($product->price) }}
                            </span>

                            <span class="inline-flex items-center gap-2
                                         text-sm text-indigo-400 font-medium">
                                View detail →
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-app-muted">
                        No products available.
                    </p>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-14 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <p class="text-sm text-app-muted">
                    Showing
                    <span class="text-white font-medium">
                        {{ $products->firstItem() }}
                    </span>
                    to
                    <span class="text-white font-medium">
                        {{ $products->lastItem() }}
                    </span>
                    of
                    <span class="text-white font-medium">
                        {{ $products->total() }}
                    </span>
                    results
                </p>

                {{ $products->links() }}
            </div>
        </div>

    </div>
</section>
@endsection
