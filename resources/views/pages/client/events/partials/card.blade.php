<a href="{{ route('events.show', $event->slug) }}"
   class="group surface surface-hover relative flex flex-col gap-6 rounded-3xl p-6 sm:flex-row">

    {{-- POSTER --}}
    <div class="relative w-full flex-shrink-0 overflow-hidden rounded-2xl border border-app-border
                bg-app-surface-2 sm:w-40 md:w-44">

        @if ($event->image)
            <img
                src="{{ asset('storage/' . $event->image) }}"
                alt="{{ $event->title }}"
                class="w-full h-full object-contain"
            >
        @else
            <div class="flex h-full items-center justify-center text-xs text-app-muted">
                No image
            </div>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="flex flex-col justify-between flex-1">

        <div class="space-y-3">

            {{-- DATE --}}
            <div class="flex items-center gap-2 text-xs text-app-muted">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10m-13 8h16
                             a2 2 0 002-2V7a2 2 0 00-2-2H5
                             a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                {{ $event->start_date->format('d M Y') }}
            </div>

            {{-- TITLE --}}
            <h3 class="text-lg font-semibold leading-snug text-app-heading">
                {{ $event->title }}
            </h3>

            {{-- LOCATION --}}
            @if ($event->location)
                <div class="flex items-center gap-2 text-sm text-app-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 21s6-5.686 6-10
                                 a6 6 0 10-12 0c0 4.314 6 10 6 10z"/>
                        <circle cx="12" cy="11" r="2.5"/>
                    </svg>
                    {{ $event->location }}
                </div>
            @endif

        </div>

        {{-- CTA --}}
        <div class="mt-4 text-sm font-medium text-brand-accent transition group-hover:translate-x-1">
            View event &rarr;
        </div>
    </div>
</a>
