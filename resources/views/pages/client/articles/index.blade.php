@extends('layouts.app')

@section('title', 'Articles')

@section('content')

<section class="bg-app-bg py-20">
    <div class="mx-auto max-w-5xl px-6">

        {{-- HEADER --}}
        <div x-data x-reveal>
            <h1 class="text-4xl font-bold tracking-tight text-app-heading sm:text-5xl">All Posts</h1>
            <p class="mt-3 text-app-muted">
                Insights, guides, and thoughts on technology, design, and digital growth.
            </p>
        </div>

        @if ($articles->isEmpty())
            <div class="surface mt-12 rounded-2xl p-12 text-center text-app-muted">
                No articles published yet. Check back soon.
            </div>
        @else
            <div class="mt-12 divide-y divide-app-border border-t border-app-border">
                @foreach ($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="group flex flex-col gap-5 py-8 sm:flex-row sm:gap-8">

                        {{-- THUMBNAIL --}}
                        <div class="shrink-0">
                            <div class="aspect-[4/3] w-full overflow-hidden rounded-xl border border-app-border bg-app-surface-2 sm:w-52">
                                @if ($article->thumbnail)
                                    <img src="{{ asset('storage/'.$article->thumbnail) }}" alt="{{ $article->title }}"
                                         class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-app-muted">
                                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.5-4.5a2 2 0 012.8 0L16 16m-2-2l1.5-1.5a2 2 0 012.8 0L20 14M4 6h16v12H4z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-app-muted">{{ $article->published_at?->format('F j, Y') }}</p>
                            <h2 class="mt-1 text-xl font-semibold leading-snug text-app-heading transition group-hover:text-brand-accent">
                                {{ $article->title }}
                            </h2>
                            @if ($article->excerpt)
                                <p class="mt-2 line-clamp-2 leading-relaxed text-app-muted">{{ $article->excerpt }}</p>
                            @endif
                            <span class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-brand-accent">
                                Read article
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
