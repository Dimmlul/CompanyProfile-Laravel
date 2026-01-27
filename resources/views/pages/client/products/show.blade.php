<!-- resources/views/pages/client/products/show.blade.php -->
@extends('layouts.app')

@section('title', $product->name)

@section('content')

<section class="py-16 bg-app-bg">
    <div class="mx-auto max-w-6xl px-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- IMAGE --}}
            <div>
                <img
                    src="{{ asset('storage/'.$product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full rounded-xl
                           border border-card-border"
                >
            </div>

            {{-- CONTENT --}}
            <div>
                <h1 class="text-3xl font-bold text-app-text">
                    {{ $product->name }}
                </h1>

                @if ($product->excerpt)
                    <p class="mt-2 text-app-muted">
                        {{ $product->excerpt }}
                    </p>
                @endif

                <p class="mt-4 text-2xl font-semibold text-app-text">
                    Rp {{ number_format($product->price) }}
                </p>

                <div class="mt-6 text-sm leading-relaxed text-app-text">
                    {!! nl2br(e($product->description)) !!}
                </div>

                <div class="mt-8">
                    <a href="{{ route('products') }}"
                       class="inline-flex items-center gap-2
                              rounded-lg
                              border border-card-border
                              px-4 py-2
                              text-sm text-app-text
                              hover:bg-app-bg transition">
                        ← Back to Products
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
