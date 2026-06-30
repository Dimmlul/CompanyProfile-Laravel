@extends('layouts.app')

@section('title', 'Events')

@section('content')
<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- ================= HEADER ================= --}}
        <div class="mb-20 max-w-2xl">
            <h1 class="text-4xl font-semibold text-app-heading">
                Events
            </h1>
            <p class="mt-4 text-app-muted">
                Discover our upcoming activities and past events.
            </p>
        </div>

        {{-- ==================================================
        | SECTION 1 — UPCOMING EVENTS
        ================================================== --}}
        <div class="mb-28">

            <div class="mb-10">
                <h2 class="text-2xl font-semibold text-app-heading">
                    Upcoming Events
                </h2>
                <p class="mt-2 text-sm text-app-muted">
                    Events happening soon and upcoming schedules.
                </p>
            </div>

            @if ($upcomingEvents->isEmpty())
                <div class="surface rounded-xl p-10 text-center">
                    <p class="text-app-muted">No upcoming events.</p>
                </div>
            @else

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($upcomingEvents as $event)
                    @include('pages.client.events.partials.card', ['event' => $event])
                @endforeach
            </div>

            {{-- PAGINATION + INFO --}}
            <div class="mt-14 flex flex-col gap-4
                        md:flex-row md:items-center md:justify-between">
                <p class="text-sm text-app-muted">
                    Showing
                    <span class="text-app-heading font-medium">
                        {{ $upcomingEvents->firstItem() }}
                    </span>
                    to
                    <span class="text-app-heading font-medium">
                        {{ $upcomingEvents->lastItem() }}
                    </span>
                    of
                    <span class="text-app-heading font-medium">
                        {{ $upcomingEvents->total() }}
                    </span>
                    upcoming events
                </p>

                {{ $upcomingEvents->links() }}
            </div>

            @endif
        </div>

        {{-- ==================================================
        | SECTION 2 — PAST EVENTS
        ================================================== --}}
        <div>

            <div class="mb-10">
                <h2 class="text-2xl font-semibold text-app-heading">
                    Past Events
                </h2>
                <p class="mt-2 text-sm text-app-muted">
                    Events that have already taken place.
                </p>
            </div>

            @if ($pastEvents->isEmpty())
                <div class="surface rounded-xl p-10 text-center">
                    <p class="text-app-muted">No past events.</p>
                </div>
            @else

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($pastEvents as $event)
                    @include('pages.client.events.partials.card', ['event' => $event])
                @endforeach
            </div>

            {{-- PAGINATION + INFO --}}
            <div class="mt-14 flex flex-col gap-4
                        md:flex-row md:items-center md:justify-between">
                <p class="text-sm text-app-muted">
                    Showing
                    <span class="text-app-heading font-medium">
                        {{ $pastEvents->firstItem() }}
                    </span>
                    to
                    <span class="text-app-heading font-medium">
                        {{ $pastEvents->lastItem() }}
                    </span>
                    of
                    <span class="text-app-heading font-medium">
                        {{ $pastEvents->total() }}
                    </span>
                    past events
                </p>

                {{ $pastEvents->links() }}
            </div>

            @endif
        </div>

    </div>
</section>
@endsection
