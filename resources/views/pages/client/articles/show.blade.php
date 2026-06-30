@extends('layouts.app')

@section('title', $article->title)

@section('content')

@php
    $readMin = max(1, (int) ceil(str_word_count(strip_tags($article->content)) / 200));
    $initial = strtoupper(mb_substr($article->author ?? 'E', 0, 1));
    $paragraphs = preg_split('/\n\s*\n/', trim((string) $article->content)) ?: [];
@endphp

{{-- Reading progress bar --}}
<div
    x-data="{
        progress: 0,
        update() {
            const el = document.documentElement;
            const max = el.scrollHeight - el.clientHeight;
            this.progress = max > 0 ? Math.min(100, (el.scrollTop / max) * 100) : 0;
        }
    }"
    x-init="update()" @scroll.window.passive="update()" @resize.window="update()"
    class="fixed inset-x-0 top-0 z-[60] h-0.5 bg-transparent"
>
    <div class="h-full bg-brand-main" :style="`width: ${progress}%`"></div>
</div>

<article class="bg-app-bg pb-24">

    {{-- ================= HERO ================= --}}
    <header class="mx-auto max-w-4xl px-6 pt-16 text-center">
        <p class="text-sm font-medium text-app-muted">
            {{ $article->published_at?->format('l, F j, Y') ?? '—' }}
        </p>
        <h1 class="mx-auto mt-4 max-w-3xl text-4xl font-bold leading-[1.1] tracking-tight text-app-heading sm:text-5xl">
            {{ $article->title }}
        </h1>
    </header>

    <div class="mx-auto max-w-6xl px-6">
        <hr class="mt-12 border-app-border">

        <div class="grid gap-10 py-12 lg:grid-cols-[220px_minmax(0,1fr)] lg:gap-16">

            {{-- ================= SIDEBAR ================= --}}
            <aside class="space-y-7 lg:sticky lg:top-24 lg:self-start">
                {{-- Author --}}
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-soft text-sm font-semibold text-brand-accent">
                        {{ $initial }}
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-app-heading">{{ $article->author ?? 'Editorial Team' }}</p>
                        <p class="text-xs text-app-muted">{{ $readMin }} min read</p>
                    </div>
                </div>

                <hr class="border-app-border">

                @if ($previous)
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-app-muted">Previous article</p>
                        <a href="{{ route('articles.show', $previous->slug) }}"
                           class="mt-2 block text-sm font-medium leading-snug text-brand-accent hover:underline">
                            {{ $previous->title }}
                        </a>
                    </div>
                @endif

                @if ($next)
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-app-muted">Next article</p>
                        <a href="{{ route('articles.show', $next->slug) }}"
                           class="mt-2 block text-sm font-medium leading-snug text-brand-accent hover:underline">
                            {{ $next->title }}
                        </a>
                    </div>
                @endif

                <x-back-button :href="route('articles')" label="Back to the blog" class="pt-1" />
            </aside>

            {{-- ================= CONTENT ================= --}}
            <div class="min-w-0 max-w-2xl">
                @if ($article->thumbnail)
                    <figure class="mb-10 overflow-hidden rounded-2xl border border-app-border">
                        <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                             class="w-full object-cover">
                    </figure>
                @endif

                @if ($article->excerpt)
                    <p class="mb-8 text-xl leading-relaxed text-app-muted">{{ $article->excerpt }}</p>
                @endif

                <div class="space-y-6 text-lg leading-8 text-app-text [&_a]:font-medium [&_a]:text-brand-accent [&_a]:underline">
                    @foreach ($paragraphs as $paragraph)
                        <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ================= MORE ================= --}}
    @if ($related->isNotEmpty())
        <section class="mx-auto mt-12 max-w-7xl px-6">
            <div class="border-t border-app-border pt-16">
                <x-section-heading x-data x-reveal class="mb-10"
                    eyebrow="Keep reading"
                    title="More from the blog" />

                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $item)
                        <x-article-card :article="$item" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</article>

@endsection
