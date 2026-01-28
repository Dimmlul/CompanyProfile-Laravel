@extends('layouts.app')

@section('title', $article->title)

@section('content')

<section class="bg-app-bg py-20">
    <div class="mx-auto max-w-3xl px-6">

        <!-- Back + Title -->
        <div class="mb-8">
            <a
                href="{{ route('articles') }}"
                class="text-sm text-gray-400 hover:text-white transition"
            >
                ← Back to Articles
            </a>

            <h1 class="mt-3 text-3xl font-semibold text-white leading-tight">
                {{ $article->title }}
            </h1>

            <div class="mt-2 flex items-center gap-4 text-sm text-gray-400">
                <span>{{ $article->published_at?->format('d M Y') }}</span>
                @if ($article->author)
                    <span>•</span>
                    <span>{{ $article->author }}</span>
                @endif
            </div>
        </div>

        <!-- Thumbnail -->
        @if ($article->thumbnail)
            <img
                src="{{ asset('storage/' . $article->thumbnail) }}"
                class="mb-10 w-full rounded-xl border border-gray-800 object-cover"
            >
        @endif

    <!-- Content -->
    <div class="mt-10 text-gray-300 leading-relaxed space-y-6">
        {!! nl2br(e($article->content)) !!}
    </div>


    </div>
</section>

@endsection
