@extends('layouts.app')

@section('title', $event->title)

@section('content')

<section class="bg-app-bg pt-24 pb-28">
    <div class="mx-auto max-w-7xl px-6">

        {{-- Back --}}
        <a href="{{ route('events') }}"
           class="mb-12 inline-flex items-center gap-2 text-sm font-medium text-app-muted transition hover:text-app-heading">
            &larr; Back to Events
        </a>

        <div class="grid grid-cols-1 gap-14 lg:grid-cols-12">

            {{-- LEFT : POSTER --}}
            <div class="flex justify-center lg:col-span-5 lg:justify-start">
                @if ($event->image)
                    <div class="surface relative w-full max-w-sm overflow-hidden rounded-3xl">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                             class="h-auto w-full object-contain">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
                    </div>
                @endif
            </div>

            {{-- RIGHT : CONTENT --}}
            <div class="lg:col-span-7">
                <h1 class="mb-6 text-4xl md:text-5xl font-semibold leading-tight text-app-heading">
                    {{ $event->title }}
                </h1>

                <div class="surface mb-12 inline-flex flex-wrap gap-x-8 gap-y-4 rounded-2xl px-6 py-4 text-sm text-app-muted">
                    <div class="flex items-center gap-2">
                        📅 {{ $event->start_date->format('d M Y') }}
                        @if ($event->end_date) &ndash; {{ $event->end_date->format('d M Y') }} @endif
                    </div>
                    @if ($event->location)
                        <div class="flex items-center gap-2">📍 {{ $event->location }}</div>
                    @endif
                </div>

                @if ($event->description)
                    <div class="surface mb-14 rounded-3xl p-8 md:p-10">
                        <p class="text-lg leading-relaxed text-app-muted">{{ $event->description }}</p>
                    </div>
                @endif

                <div class="space-y-4 text-base leading-relaxed text-app-text">
                    {!! nl2br(e($event->content)) !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
