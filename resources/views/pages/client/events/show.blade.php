@extends('layouts.app')

@section('title', $event->title)

@section('content')

{{-- ================= HERO IMAGE ================= --}}
<section class="relative bg-app-bg">
    <div class="mx-auto max-w-7xl px-6 pt-24">

        {{-- Back --}}
        <a href="{{ route('events') }}"
           class="mb-8 inline-flex items-center gap-2 text-sm text-app-muted hover:text-white transition">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Events
        </a>

    </div>

    @if ($event->image)
        <div class="relative mx-auto max-w-7xl px-6">
            <img
                src="{{ asset('storage/' . $event->image) }}"
                alt="{{ $event->title }}"
                class="h-[420px] w-full rounded-3xl object-cover"
            >

            {{-- Overlay --}}
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-t
                        from-app-bg via-app-bg/40 to-transparent"></div>
        </div>
    @endif
</section>

{{-- ================= CONTENT ================= --}}
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-5xl px-6">

        {{-- Title --}}
        <h1 class="mb-6 text-4xl md:text-5xl font-semibold leading-tight text-white">
            {{ $event->title }}
        </h1>

        {{-- Meta Info --}}
        <div class="mb-10 flex flex-wrap gap-6 text-sm text-app-muted">

            {{-- Date --}}
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3M3 11h18"/>
                </svg>
                <span>
                    {{ $event->start_date->format('d M Y') }}
                    @if ($event->end_date)
                        – {{ $event->end_date->format('d M Y') }}
                    @endif
                </span>
            </div>

            {{-- Location --}}
            @if ($event->location)
                <div class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                    </svg>
                    <span>{{ $event->location }}</span>
                </div>
            @endif
        </div>

        {{-- Description Card --}}
        @if ($event->description)
            <div class="mb-16 rounded-2xl
                        bg-gradient-to-b from-slate-800/60 to-slate-900/70
                        border border-white/10 p-8 md:p-10">
                <p class="text-lg leading-relaxed text-app-muted">
                    {{ $event->description }}
                </p>
            </div>
        @endif

        {{-- Main Content --}}
        <article class="prose prose-invert max-w-none
                        prose-p:leading-relaxed
                        prose-p:text-app-muted
                        prose-headings:text-white">
            {!! nl2br(e($event->content)) !!}
        </article>

    </div>
</section>

@endsection
