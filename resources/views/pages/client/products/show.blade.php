@extends('layouts.app')

@section('title', $product->name)

@section('content')

@php
    $body = filled($product->content) ? $product->content : $product->description;
    $deliveryLabel = match ($product->delivery_type) {
        'file' => 'Instant file download',
        'link' => 'Access via link',
        default => 'Digital product',
    };
    $paragraphs = filled($body) ? (preg_split('/\n\s*\n/', trim((string) $body)) ?: []) : [];
@endphp

<section class="bg-app-bg py-12 lg:py-16">
    <div class="mx-auto max-w-6xl px-6">

        <x-back-button :href="route('products')" label="Back to products" class="mb-6" />

        <x-breadcrumb class="mb-10" :items="[
            ['label' => 'Home', 'href' => route('home')],
            ['label' => 'Products', 'href' => route('products')],
            ['label' => $product->name],
        ]" />

        <div class="grid gap-10 lg:grid-cols-2 lg:gap-16">

            {{-- IMAGE — shown in full, no crop --}}
            <div class="lg:sticky lg:top-24 lg:self-start">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                     class="w-full rounded-2xl border border-app-border">
            </div>

            {{-- INFO --}}
            <div class="lg:py-2">
                <span class="text-sm font-medium text-brand-accent">{{ $deliveryLabel }}</span>

                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-app-heading lg:text-4xl">
                    {{ $product->name }}
                </h1>

                <div class="mt-5">
                    @if (filled($product->price))
                        <p class="text-3xl font-semibold text-app-heading">Rp {{ number_format($product->price) }}</p>
                    @else
                        <p class="text-2xl font-semibold text-app-heading">Custom pricing</p>
                    @endif
                </div>

                @if (filled($product->description))
                    <p class="mt-6 leading-relaxed text-app-muted">{{ $product->description }}</p>
                @endif

                {{-- ACTIONS --}}
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
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

                {{-- subtle trust line (no rigid box) --}}
                <p class="mt-5 flex flex-wrap items-center gap-x-2 gap-y-1 text-xs text-app-muted">
                    <svg class="h-4 w-4 text-brand-accent" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Instant access after payment
                    <span class="text-app-muted/40">•</span>
                    Secure checkout via Midtrans
                </p>

                {{-- ABOUT --}}
                @if (count($paragraphs))
                    <div class="mt-10 border-t border-app-border pt-8">
                        <h2 class="text-lg font-semibold text-app-heading">About this product</h2>
                        <div class="mt-4 space-y-4 leading-relaxed text-app-text">
                            @foreach ($paragraphs as $paragraph)
                                <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- RELATED --}}
@if ($related->isNotEmpty())
    <section class="bg-app-bg pb-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="border-t border-app-border pt-16">
                <x-section-heading x-data x-reveal class="mb-10"
                    eyebrow="More to explore"
                    title="Other products" />

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $item)
                        <x-product-card :product="$item" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@endsection
