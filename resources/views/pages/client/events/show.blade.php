@extends('layouts.app')

@section('title', $event->title)

@section('content')

<section class="bg-app-bg pt-24 pb-28">
    <div class="mx-auto max-w-7xl px-6">

        {{-- Back --}}
        <a href="{{ route('events') }}"
           class="mb-12 inline-flex items-center gap-2 text-sm font-medium
                  text-app-muted hover:text-white transition">
            ← Back to Events
        </a>

        {{-- MAIN GRID --}}
        <div class="grid grid-cols-1 gap-14 lg:grid-cols-12">

            {{-- LEFT : POSTER --}}
            <div class="lg:col-span-5 flex justify-center lg:justify-start">
                @if ($event->image)
                    <div class="relative w-full max-w-sm
                                rounded-3xl overflow-hidden
                                bg-slate-900/80 border border-white/10">

                        <img
                            src="{{ asset('storage/' . $event->image) }}"
                            alt="{{ $event->title }}"
                            class="w-full h-auto object-contain"
                        >

                        {{-- Soft glow --}}
                        <div class="absolute inset-0
                                    bg-gradient-to-t from-black/30 via-transparent to-transparent">
                        </div>
                    </div>
                @endif
            </div>

            {{-- RIGHT : CONTENT --}}
            <div class="lg:col-span-7">

                {{-- TITLE --}}
                <h1 class="mb-6 text-4xl md:text-5xl font-semibold leading-tight text-white">
                    {{ $event->title }}
                </h1>

                {{-- META --}}
                <div class="mb-12 inline-flex flex-wrap gap-x-8 gap-y-4
                            rounded-2xl border border-white/10
                            bg-slate-900/50 px-6 py-4 text-sm text-app-muted">

                    {{-- Date --}}
                    <div class="flex items-center gap-2">
                        📅
                        {{ $event->start_date->format('d M Y') }}
                        @if ($event->end_date)
                            – {{ $event->end_date->format('d M Y') }}
                        @endif
                    </div>

                    {{-- Location --}}
                    @if ($event->location)
                        <div class="flex items-center gap-2">
                            📍 {{ $event->location }}
                        </div>
                    @endif
                </div>

                {{-- DESCRIPTION --}}
                @if ($event->description)
                    <div class="mb-14 rounded-3xl
                                bg-gradient-to-b from-slate-800/60 to-slate-900/80
                                border border-white/10 p-8 md:p-10">
                        <p class="text-lg leading-relaxed text-app-muted">
                            {{ $event->description }}
                        </p>
                    </div>
                @endif

                {{-- CONTENT --}}
                <article class="prose prose-invert max-w-none
                                prose-p:leading-relaxed
                                prose-p:text-app-muted
                                prose-headings:text-white">
                    {!! nl2br(e($event->content)) !!}
                </article>

            </div>

        </div>
    </div>
</section>

@endsection
