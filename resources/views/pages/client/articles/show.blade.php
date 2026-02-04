@extends('layouts.app')

@section('title', $article->title)

@section('content')

<section class="bg-app-bg py-24">
    <div class="mx-auto max-w-3xl px-6">

        {{-- ================= HEADER ================= --}}
        <header class="mb-12">

            <a
                href="{{ route('articles') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white transition"
            >
                <span>←</span>
                <span>Back to Articles</span>
            </a>

            <h1 class="mt-5 text-3xl md:text-4xl font-semibold text-white leading-tight tracking-tight">
                {{ $article->title }}
            </h1>

            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm text-gray-400">
                <span>{{ $article->published_at?->format('d M Y') }}</span>

                @if ($article->author)
                    <span class="opacity-50">•</span>
                    <span>{{ $article->author }}</span>
                @endif
            </div>

        </header>

        {{-- ================= THUMBNAIL ================= --}}
        @if ($article->thumbnail)
            <figure class="mb-14">
                <img
                    src="{{ asset('storage/' . $article->thumbnail) }}"
                    class="w-full rounded-2xl border border-white/10 object-cover"
                    alt="{{ $article->title }}"
                >
            </figure>
        @endif

        {{-- ================= CONTENT ================= --}}
        <article class="prose prose-invert prose-lg max-w-none text-gray-300">
            {!! nl2br(e($article->content)) !!}
        </article>

        {{-- ================= FOOTER ================= --}}
        <footer class="mt-16 border-t border-white/5 pt-8">
            <p class="text-sm text-gray-500">
                Written by
                <span class="text-gray-300 font-medium">
                    {{ $article->author ?? 'Editorial Team' }}
                </span>
            </p>
        </footer>

    </div>
</section>

@endsection
