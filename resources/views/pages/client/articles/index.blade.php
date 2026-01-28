@extends('layouts.app')

@section('title', 'Articles')

@section('content')

<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-7xl px-6">

        {{-- HEADER --}}
        <div class="mb-16 max-w-2xl">
            <h1 class="text-4xl font-semibold text-white">
                Articles & Insights
            </h1>
            <p class="mt-4 text-app-muted">
                Insights, guides, and thoughts from Nexora Studio on technology,
                design, and digital growth.
            </p>
        </div>

        {{-- EMPTY STATE --}}
        @if ($articles->isEmpty())
            <div class="rounded-xl border border-white/10 bg-white/5 p-10 text-center">
                <p class="text-app-muted">No articles available yet.</p>
            </div>
        @else

        {{-- GRID --}}
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

            @foreach ($articles as $article)
                <a
                    href="{{ route('articles.show', $article->slug) }}"
                    class="group rounded-2xl border border-white/10 bg-white/5 p-6
                           transition hover:border-indigo-400/40 hover:bg-white/10"
                >

                    {{-- THUMBNAIL --}}
                    @if ($article->thumbnail)
                        <img
                            src="{{ asset('storage/'.$article->thumbnail) }}"
                            alt="{{ $article->title }}"
                            class="mb-5 h-44 w-full rounded-xl object-cover"
                        >
                    @endif

                    {{-- DATE --}}
                    <div class="mb-2 flex items-center gap-2 text-xs text-app-muted">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 11H5m14-4H5m14 8H5"/>
                        </svg>
                        {{ $article->published_at?->format('d M Y') ?? '-' }}
                    </div>

                    {{-- TITLE --}}
                    <h3 class="mb-2 text-lg font-semibold text-white
                               group-hover:text-indigo-300 transition">
                        {{ $article->title }}
                    </h3>

                    {{-- EXCERPT --}}
                    <p class="text-sm text-app-muted line-clamp-3">
                        {{ $article->excerpt }}
                    </p>

                    {{-- READ MORE --}}
                    <div class="mt-4 flex items-center gap-2 text-sm font-medium text-indigo-400">
                        Read article
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1"
                             fill="none" stroke="currentColor" stroke-width="1.5"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>

                </a>
            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-14">
            {{ $articles->links() }}
        </div>

        @endif
    </div>
</section>

@endsection
