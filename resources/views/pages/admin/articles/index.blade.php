{{-- FILE: admin/articles/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Articles')

@section('content')

<x-common.component-card title="Articles">

    {{-- HEADER --}}
    <div class="mb-4 flex items-center justify-between">
        <p class="text-sm text-text-muted">
            Manage articles
        </p>

        <a href="{{ route('admin.articles.create') }}"
           class="btn-primary">
            + New Article
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="admin-table">

            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Excerpt</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th>Created</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($articles as $article)
                    <tr>

                        <td>
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/'.$article->thumbnail) }}"
                                     class="h-12 w-16 rounded object-cover">
                            @else
                                <span class="text-text-muted text-xs">No image</span>
                            @endif
                        </td>

                        <td class="font-medium">
                            {{ $article->title }}
                        </td>

                        <td class="text-text-muted max-w-xs">
                            {{ $article->excerpt ?? '-' }}
                        </td>

                        <td class="text-text-muted">
                            {{ $article->author ?? '-' }}
                        </td>

                        <td>
                            @if ($article->is_published)
                                <span class="badge badge-success">Published</span>
                            @else
                                <span class="badge badge-muted">Draft</span>
                            @endif
                        </td>

                        <td class="text-text-muted">
                            {{ $article->published_at?->format('d M Y') ?? '-' }}
                        </td>

                        <td class="text-text-muted">
                            {{ $article->created_at->format('d M Y') }}
                        </td>

                        <td class="text-right">
                            <div class="inline-flex gap-2">
                                <a href="{{ route('admin.articles.edit', $article) }}"
                                   class="btn-admin">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.articles.destroy', $article) }}"
                                      onsubmit="return confirm('Delete this article?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="admin-table-empty">
                            No articles found
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>

</x-common.component-card>

@endsection
