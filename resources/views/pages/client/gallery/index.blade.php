@extends('layouts.app')

@section('title', 'Gallery')

@section('content')

@php
    $categories = $galleries->pluck('category')->filter()->unique()->values();
@endphp

<section class="bg-app-bg py-20" x-data="{ cat: 'all', open: false, active: {} }">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div x-data x-reveal class="mb-10 max-w-2xl">
            <span class="eyebrow">Gallery</span>
            <h1 class="section-title">Moments &amp; documentation</h1>
            <p class="section-subtitle">A look at our activities, projects, and behind-the-scenes.</p>
        </div>

        {{-- FILTER --}}
        @if ($categories->isNotEmpty())
            <div class="mb-10 flex flex-wrap gap-2">
                <button type="button" @click="cat = 'all'"
                        :class="cat === 'all' ? 'btn-primary btn-sm' : 'btn-outline btn-sm'">All</button>
                @foreach ($categories as $c)
                    <button type="button" @click="cat = @js($c)"
                            :class="cat === @js($c) ? 'btn-primary btn-sm' : 'btn-outline btn-sm'">{{ ucfirst($c) }}</button>
                @endforeach
            </div>
        @endif

        {{-- GRID --}}
        @if ($galleries->isEmpty())
            <div class="surface rounded-2xl p-12 text-center text-app-muted">No gallery items yet.</div>
        @else
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($galleries as $gallery)
                    <button type="button"
                            x-show="cat === 'all' || cat === @js($gallery->category)" x-transition
                            @click="open = true; active = { img: @js(asset('storage/'.$gallery->image)), title: @js($gallery->title), caption: @js($gallery->caption) }"
                            class="group surface relative aspect-square overflow-hidden rounded-2xl text-left">
                        <img src="{{ asset('storage/'.$gallery->image) }}" alt="{{ $gallery->title }}"
                             class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/10 to-transparent p-4 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            <p class="text-sm font-semibold text-white">{{ $gallery->title }}</p>
                            @if ($gallery->caption)
                                <p class="line-clamp-1 text-xs text-white/70">{{ $gallery->caption }}</p>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>
        @endif
    </div>

    {{-- LIGHTBOX --}}
    <div x-show="open" x-transition.opacity x-cloak
         @keydown.escape.window="open = false" @click.self="open = false"
         class="fixed inset-0 z-[80] flex items-center justify-center bg-black/85 p-6 backdrop-blur-sm">
        <div class="relative w-full max-w-4xl">
            <button type="button" @click="open = false"
                    class="absolute -top-9 right-0 inline-flex items-center gap-1.5 text-sm text-white/80 transition hover:text-white">
                Close
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img :src="active.img" :alt="active.title" class="max-h-[80vh] w-full rounded-2xl object-contain">
            <div class="mt-3 text-center">
                <p class="text-sm font-medium text-white" x-text="active.title"></p>
                <p class="text-xs text-white/60" x-text="active.caption"></p>
            </div>
        </div>
    </div>
</section>

@endsection
