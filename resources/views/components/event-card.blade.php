@props(['event'])

{{-- Reusable event card (events grid + "other events"). --}}
@php
    $isUpcoming = $event->start_date->isToday() || $event->start_date->isFuture();
@endphp

<a href="{{ route('events.show', $event->slug) }}"
   class="group surface surface-hover flex flex-col overflow-hidden rounded-2xl">

    <div class="relative aspect-[16/10] overflow-hidden">
        @if ($event->image)
            <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
        @else
            <div class="flex h-full items-center justify-center bg-app-surface-2 text-sm text-app-muted">No image</div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

        <span class="absolute left-4 top-4 rounded-full border border-white/15 bg-black/50 px-3 py-1 text-xs font-medium text-white backdrop-blur">
            {{ $isUpcoming ? 'Upcoming' : 'Past' }}
        </span>
    </div>

    <div class="flex flex-1 flex-col p-6">
        <div class="flex items-center gap-2 text-xs text-app-muted">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
            </svg>
            {{ $event->start_date->format('d M Y') }}
        </div>

        <h3 class="mt-2 text-lg font-semibold leading-snug text-app-heading transition group-hover:text-brand-accent">
            {{ $event->title }}
        </h3>

        @if ($event->location)
            <div class="mt-2 flex items-center gap-2 text-sm text-app-muted">
                <svg class="h-4 w-4 flex-none" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s6-5.686 6-10a6 6 0 10-12 0c0 4.314 6 10 6 10z"/>
                    <circle cx="12" cy="11" r="2.5"/>
                </svg>
                <span class="truncate">{{ $event->location }}</span>
            </div>
        @endif

        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-medium text-brand-accent transition group-hover:gap-2.5">
            View event
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </span>
    </div>
</a>
