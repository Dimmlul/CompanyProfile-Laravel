@extends('layouts.app')

@section('title', 'Products')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div class="mb-20 text-center max-w-2xl mx-auto">
            <h1 class="text-4xl font-semibold text-app-heading">Our Products</h1>
            <p class="mt-4 leading-relaxed text-app-muted">
                Explore our professional digital products and services designed to help your business grow.
            </p>
        </div>

        @php
            $sections = [
                ['Newest Products', 'Our latest products and offerings.', $newestProducts, 'No new products available.'],
                ['All Products', 'Browse all available products.', $products, 'No products available.'],
            ];
        @endphp

        @foreach ($sections as [$heading, $sub, $items, $emptyText])
            <div class="@if(!$loop->last) mb-28 @endif">
                <div class="mb-10">
                    <h2 class="text-2xl font-semibold text-app-heading">{{ $heading }}</h2>
                    <p class="mt-2 text-sm text-app-muted">{{ $sub }}</p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse ($items as $product)
                        <a href="{{ route('products.show', $product) }}"
                           class="group surface surface-hover rounded-2xl p-6">
                            @if ($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}"
                                     class="mb-5 h-44 w-full rounded-xl object-cover">
                            @endif

                            <h3 class="mb-2 text-lg font-semibold text-app-heading transition group-hover:text-brand-accent">
                                {{ $product->name }}
                            </h3>

                            @if ($product->excerpt)
                                <p class="line-clamp-3 text-sm text-app-muted">{{ $product->excerpt }}</p>
                            @endif

                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm font-semibold text-app-heading">Rp {{ number_format($product->price) }}</span>
                                <span class="text-sm font-medium text-brand-accent">View detail &rarr;</span>
                            </div>
                        </a>
                    @empty
                        <p class="col-span-full text-app-muted">{{ $emptyText }}</p>
                    @endforelse
                </div>

                @if ($heading === 'All Products')
                    <div class="mt-14 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <p class="text-sm text-app-muted">
                            Showing
                            <span class="font-medium text-app-heading">{{ $products->firstItem() }}</span> to
                            <span class="font-medium text-app-heading">{{ $products->lastItem() }}</span> of
                            <span class="font-medium text-app-heading">{{ $products->total() }}</span> results
                        </p>
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endsection
