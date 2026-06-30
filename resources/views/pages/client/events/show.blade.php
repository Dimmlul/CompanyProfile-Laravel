@extends('layouts.app')

@section('title', $event->title)

@section('content')

@php
    $isUpcoming = $event->start_date->isToday() || $event->start_date->isFuture();
    $body = filled($event->content) ? $event->content : null;
    $paragraphs = $body ? (preg_split('/\n\s*\n/', trim((string) $body)) ?: []) : [];
@endphp

<section class="bg-app-bg py-12 lg:py-16">
    <div class="mx-auto max-w-6xl px-6">

        <x-back-button :href="route('events')" label="Back to events" class="mb-6" />

        <x-breadcrumb class="mb-10" :items="[
            ['label' => 'Home', 'href' => route('home')],
            ['label' => 'Events', 'href' => route('events')],
            ['label' => $event->title],
        ]" />

        <div class="grid gap-10 lg:grid-cols-2 lg:gap-16">

            {{-- POSTER --}}
            <div class="lg:sticky lg:top-24 lg:self-start">
                @if ($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                         class="w-full rounded-2xl border border-app-border">
                @else
                    <div class="surface flex aspect-[4/3] items-center justify-center rounded-2xl text-app-muted">No image</div>
                @endif
            </div>

            {{-- INFO --}}
            <div class="lg:py-2">
                <span class="inline-flex items-center gap-2 rounded-full bg-brand-soft px-3 py-1 text-xs font-medium text-brand-accent">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-accent"></span>
                    {{ $isUpcoming ? 'Upcoming event' : 'Past event' }}
                </span>

                <h1 class="mt-4 text-3xl font-semibold leading-tight tracking-tight text-app-heading lg:text-4xl">
                    {{ $event->title }}
                </h1>

                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex items-center gap-3 text-app-muted">
                        <svg class="h-5 w-5 flex-none text-brand-accent" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                        </svg>
                        <span class="text-app-heading">
                            {{ $event->start_date->format('d M Y') }}
                            @if ($event->end_date && !$event->end_date->isSameDay($event->start_date))
                                &ndash; {{ $event->end_date->format('d M Y') }}
                            @endif
                        </span>
                    </div>

                    @if ($event->location)
                        <div class="flex items-center gap-3 text-app-muted">
                            <svg class="h-5 w-5 flex-none text-brand-accent" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s6-5.686 6-10a6 6 0 10-12 0c0 4.314 6 10 6 10z"/>
                                <circle cx="12" cy="11" r="2.5"/>
                            </svg>
                            <span class="text-app-heading">{{ $event->location }}</span>
                        </div>
                    @endif
                </div>

                @if ($event->description)
                    <p class="mt-6 text-lg leading-relaxed text-app-muted">{{ $event->description }}</p>
                @endif

                @if (count($paragraphs))
                    <div class="mt-8 space-y-5 leading-relaxed text-app-text">
                        @foreach ($paragraphs as $paragraph)
                            <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                        @endforeach
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
                    eyebrow="Don't miss"
                    title="Other events" />

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $item)
                        <x-event-card :event="$item" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@endsection
