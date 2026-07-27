{{-- Events listing page: grid of upcoming events and an archive of past events. --}}
@extends('layouts.app')

@section('title', 'Events')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div x-data x-reveal class="mb-16 max-w-2xl">
            <span class="eyebrow">What's on</span>
            <h1 class="section-title">Events</h1>
            <p class="section-subtitle">Discover our upcoming activities and look back at past events.</p>
        </div>

        {{-- UPCOMING --}}
        <div class="mb-20">
            <h2 x-data x-reveal class="mb-8 text-xl font-semibold text-app-heading">Upcoming events</h2>

            @if ($upcomingEvents->isEmpty())
                <div class="surface rounded-2xl p-12 text-center text-app-muted">No upcoming events right now.</div>
            @else
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($upcomingEvents as $event)
                        <x-event-card :event="$event" />
                    @endforeach
                </div>
                <div class="mt-12">{{ $upcomingEvents->links() }}</div>
            @endif
        </div>

        {{-- PAST --}}
        <div>
            <h2 x-data x-reveal class="mb-8 text-xl font-semibold text-app-heading">Past events</h2>

            @if ($pastEvents->isEmpty())
                <div class="surface rounded-2xl p-12 text-center text-app-muted">No past events yet.</div>
            @else
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($pastEvents as $event)
                        <x-event-card :event="$event" />
                    @endforeach
                </div>
                <div class="mt-12">{{ $pastEvents->links() }}</div>
            @endif
        </div>
    </div>
</section>
@endsection
