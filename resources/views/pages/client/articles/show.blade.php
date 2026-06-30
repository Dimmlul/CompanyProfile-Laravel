@extends('layouts.app')

@section('title', $article->title)

@section('content')

<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-3xl px-6">

        {{-- HEADER --}}
        <header class="mb-12">
            <a href="{{ route('articles') }}"
               class="inline-flex items-center gap-2 text-sm text-app-muted transition hover:text-app-heading">
                <span>&larr;</span>
                <span>Back to Articles</span>
            </a>

            <h1 class="mt-5 text-3xl md:text-4xl font-semibold leading-tight tracking-tight text-app-heading">
                {{ $article->title }}
            </h1>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-app-muted">
                <span>{{ $article->published_at?->format('d M Y') }}</span>
                @if ($article->author)
                    <span class="opacity-50">&bull;</span>
                    <span>{{ $article->author }}</span>
                @endif
            </div>
        </header>

        {{-- THUMBNAIL --}}
        @if ($article->thumbnail)
            <figure class="mb-14">
                <img src="{{ asset('storage/' . $article->thumbnail) }}"
                     class="w-full rounded-2xl border border-app-border object-cover" alt="{{ $article->title }}">
            </figure>
        @endif

        {{-- CONTENT --}}
        <article class="space-y-5 text-base leading-relaxed text-app-text">
            {!! nl2br(e($article->content)) !!}
        </article>

        {{-- FOOTER --}}
        <footer class="mt-16 border-t border-app-border pt-8">
            <p class="text-sm text-app-muted">
                Written by
                <span class="font-medium text-app-heading">{{ $article->author ?? 'Editorial Team' }}</span>
            </p>
        </footer>
    </div>
</section>

@endsection
