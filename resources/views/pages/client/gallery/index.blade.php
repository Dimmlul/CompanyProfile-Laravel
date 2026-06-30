@extends('layouts.app')

@section('title', 'Gallery')

@section('content')

<section class="py-20 bg-app-bg">
    <div class="mx-auto max-w-7xl px-6">

        {{-- ================= HEADER ================= --}}
        <div class="mb-14 text-center">
            <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-app-heading">
                Gallery
            </h1>
            <p class="mt-3 max-w-xl mx-auto text-sm text-app-muted">
                A collection of our activities, moments, and documentation
            </p>
        </div>

        {{-- ================= GALLERY GRID ================= --}}
        <div
            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4
                   gap-6"
        >

            @foreach ($galleries as $gallery)

                <div class="group surface surface-hover relative overflow-hidden rounded-2xl">

                    {{-- IMAGE --}}
                    <img
                        src="{{ asset('storage/'.$gallery->image) }}"
                        alt="{{ $gallery->title }}"
                        class="h-60 w-full object-cover
                               transition-transform duration-700 ease-out
                               group-hover:scale-105"
                    >

                    {{-- OVERLAY --}}
                    <div
                        class="absolute inset-0
                               flex flex-col justify-end
                               p-5
                               bg-gradient-to-t
                               from-black/80 via-black/40 to-transparent
                               opacity-0
                               transition-opacity duration-300
                               group-hover:opacity-100"
                    >
                        <h3 class="text-sm font-semibold text-white leading-snug">
                            {{ $gallery->title }}
                        </h3>

                        @if ($gallery->caption)
                            <p class="mt-1 text-xs text-white/80 line-clamp-2">
                                {{ $gallery->caption }}
                            </p>
                        @endif
                    </div>

                </div>

            @endforeach

        </div>

        {{-- EMPTY STATE --}}
        @if ($galleries->isEmpty())
            <div class="mt-16 text-center text-sm text-app-muted">
                No gallery items available.
            </div>
        @endif

    </div>
</section>

@endsection
