<a href="{{ route('events.show', $event->slug) }}"
   class="group rounded-2xl border border-white/10 bg-white/5 p-6
          transition hover:border-indigo-400/40 hover:bg-white/10">

    @if ($event->image)
        <img
            src="{{ asset('storage/' . $event->image) }}"
            alt="{{ $event->title }}"
            class="mb-5 h-44 w-full rounded-xl object-cover">
    @endif

    <div class="mb-2 flex items-center gap-2 text-xs text-app-muted">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
        </svg>
        {{ $event->start_date?->format('d M Y') ?? '-' }}
    </div>

    <h3 class="mb-2 text-lg font-semibold text-white
               group-hover:text-indigo-300 transition">
        {{ $event->title }}
    </h3>

    @if ($event->location)
        <div class="flex items-center gap-2 text-sm text-app-muted">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
            </svg>
            {{ $event->location }}
        </div>
    @endif

    <div class="mt-4 inline-flex items-center gap-2
                text-sm font-medium text-indigo-400">
        View event
        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1"
             fill="none" stroke="currentColor" stroke-width="1.5"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M9 5l7 7-7 7"/>
        </svg>
    </div>
</a>
