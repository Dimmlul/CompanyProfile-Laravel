{{-- Admin page listing all articles with pagination and a link to create a new one. --}}
@extends('layouts.admin')

@section('title', 'Articles')

@section('content')

<x-common.component-card title="Articles">

    {{-- HEADER --}}
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage articles
        </p>

        <a
            href="{{ route('admin.articles.create') }}"
            class="btn-primary"
        >
            + New Article
        </a>
    </div>

    {{-- TABLE --}}
    <x-admin.article.table :articles="$articles" />

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $articles->links() }}
    </div>

</x-common.component-card>

@endsection
