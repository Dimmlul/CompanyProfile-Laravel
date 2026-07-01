@extends('layouts.app')

@section('title', $event->title)

@section('content')

@php
    $isUpcoming = $event->start_date->isToday() || $event->start_date->isFuture();
    $multiDay   = $event->end_date && !$event->end_date->isSameDay($event->start_date);
    $paragraphs = filled($event->content) ? (preg_split('/\n\s*\n/', trim((string) $event->content)) ?: []) : [];

    // Google Calendar "add event" link (upcoming events only).
    $calEnd = $event->end_date ?? $event->start_date->copy()->addHours(2);
    $calendarUrl = 'https://calendar.google.com/calendar/render?' . http_build_query([
        'action'   => 'TEMPLATE',
        'text'     => $event->title,
        'dates'    => $event->start_date->format('Ymd\THis') . '/' . $calEnd->format('Ymd\THis'),
        'details'  => $event->description ?? '',
        'location' => $event->location ?? '',
    ]);
@endphp

<section class="bg-app-bg py-10 lg:py-14">
    <div class="mx-auto max-w-6xl px-6">

        <x-back-button :href="route('events')" label="Back to events" class="mb-6" />

        <x-breadcrumb class="mb-8" :items="[
            ['label' => 'Home', 'href' => route('home')],
            ['label' => 'Events', 'href' => route('events')],
            ['label' => $event->title],
        ]" />

        {{-- ================= HERO BANNER ================= --}}
        @if ($event->image)
            <div class="relative overflow-hidden rounded-3xl border border-app-border">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                     class="h-[320px] w-full object-cover sm:h-[440px]">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent"></div>

                <div class="absolute inset-x-0 bottom-0 p-6 sm:p-10">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-medium text-white backdrop-blur">
                        <span class="h-1.5 w-1.5 rounded-full {{ $isUpcoming ? 'bg-green-400' : 'bg-white/60' }}"></span>
                        {{ $isUpcoming ? 'Upcoming event' : 'Past event' }}
                    </span>
                    <h1 class="mt-4 max-w-3xl text-3xl font-semibold leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl">
                        {{ $event->title }}
                    </h1>
                </div>
            </div>
        @else
            <div>
                <span class="inline-flex items-center gap-2 rounded-full bg-brand-soft px-3 py-1 text-xs font-medium text-brand-accent">
                    <span class="h-1.5 w-1.5 rounded-full bg-brand-accent"></span>
                    {{ $isUpcoming ? 'Upcoming event' : 'Past event' }}
                </span>
                <h1 class="mt-4 text-3xl font-semibold leading-tight tracking-tight text-app-heading sm:text-4xl lg:text-5xl">
                    {{ $event->title }}
                </h1>
            </div>
        @endif

        {{-- ================= BODY + DETAILS ================= --}}
        <div class="mt-10 grid gap-10 lg:grid-cols-[1fr_340px] lg:gap-14">

            {{-- Content --}}
            <div class="min-w-0">
                @if ($event->description)
                    <p class="text-xl leading-relaxed text-app-muted">{{ $event->description }}</p>
                @endif

                @if (count($paragraphs))
                    <div class="mt-8 space-y-5 leading-relaxed text-app-text">
                        @foreach ($paragraphs as $paragraph)
                            <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Details card --}}
            <aside class="lg:sticky lg:top-24 lg:self-start">
                <div class="surface space-y-5 rounded-2xl p-6">
                    <h3 class="text-sm font-semibold text-app-heading">Event details</h3>

                    {{-- Date --}}
                    <div class="flex gap-3">
                        <svg class="mt-0.5 h-5 w-5 flex-none text-brand-accent" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
                        </svg>
                        <div class="text-sm">
                            <p class="font-medium text-app-heading">{{ $event->start_date->format('l, d M Y') }}</p>
                            <p class="text-app-muted">
                                @if ($multiDay)
                                    until {{ $event->end_date->format('d M Y') }}
                                @else
                                    {{ $event->start_date->format('H:i') }}@if ($event->end_date) &ndash; {{ $event->end_date->format('H:i') }}@endif
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Location --}}
                    @if ($event->location)
                        <div class="flex gap-3">
                            <svg class="mt-0.5 h-5 w-5 flex-none text-brand-accent" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s6-5.686 6-10a6 6 0 10-12 0c0 4.314 6 10 6 10z"/>
                                <circle cx="12" cy="11" r="2.5"/>
                            </svg>
                            <p class="text-sm font-medium text-app-heading">{{ $event->location }}</p>
                        </div>
                    @endif

                    @if ($isUpcoming)
                        <a href="{{ $calendarUrl }}" target="_blank" rel="noopener" class="btn-primary w-full">
                            Add to calendar
                        </a>
                    @endif
                </div>
            </aside>
        </div>

        {{-- ================= MAP ================= --}}
        @if (filled($event->location) || (filled($event->latitude) && filled($event->longitude)))
            <div class="mt-12 border-t border-app-border pt-10">
                <h2 class="mb-4 text-lg font-semibold text-app-heading">Location</h2>
                <x-map :lat="$event->latitude" :lng="$event->longitude" :address="$event->location" :label="$event->title" height="360px" />
            </div>
        @endif
    </div>
</section>

{{-- ================= RELATED ================= --}}
@if ($related->isNotEmpty())
    <section class="bg-app-bg pb-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="border-t border-app-border pt-16">
                <x-section-heading x-data x-reveal class="mb-10" eyebrow="Don't miss" title="Other events" />
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
