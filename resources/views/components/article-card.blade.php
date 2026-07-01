@props(['article'])

{{-- Reusable article preview card (blog grid + "more articles"). --}}
<a href="{{ route('articles.show', $article->slug) }}"
   class="group surface surface-hover flex flex-col overflow-hidden rounded-2xl">

    @if ($article->thumbnail)
        <div class="aspect-[16/9] overflow-hidden">
            <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}"
                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
        </div>
    @endif

    <div class="flex flex-1 flex-col p-6">
        <div class="mb-2 flex items-center gap-2 text-xs text-app-muted">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v13a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"/>
            </svg>
            {{ $article->published_at?->format('d M Y') ?? '-' }}
        </div>

        <h3 class="text-lg font-semibold leading-snug text-app-heading transition group-hover:text-brand-accent">
            {{ $article->title }}
        </h3>

        @if ($article->excerpt)
            <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-app-muted">{{ $article->excerpt }}</p>
        @endif

        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-medium text-brand-accent transition group-hover:gap-2.5">
            Read article
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </span>
    </div>
</a>
