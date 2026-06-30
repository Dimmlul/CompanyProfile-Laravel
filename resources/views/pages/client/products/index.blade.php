@extends('layouts.app')

@section('title', 'Products')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div x-data x-reveal class="mb-16 max-w-2xl">
            <span class="eyebrow">What we offer</span>
            <h1 class="section-title">Products &amp; services</h1>
            <p class="section-subtitle">
                Professional digital products and services designed to help your business grow.
            </p>
        </div>

        {{-- NEWEST --}}
        @if ($newestProducts->isNotEmpty())
            <div class="mb-20">
                <div x-data x-reveal class="mb-8 flex items-end justify-between">
                    <h2 class="text-xl font-semibold text-app-heading">Newest</h2>
                    <span class="text-sm text-app-muted">Fresh from the studio</span>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($newestProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ALL --}}
        <div>
            <h2 x-data x-reveal class="mb-8 text-xl font-semibold text-app-heading">All products</h2>

            @if ($products->isEmpty())
                <div class="surface rounded-2xl p-12 text-center text-app-muted">No products available yet.</div>
            @else
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <div class="mt-14">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
