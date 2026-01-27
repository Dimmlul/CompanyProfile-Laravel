@extends('layouts.admin')

@section('title', 'Articles')

@section('content')

<x-common.component-card title="Articles">

    <!-- Header -->
    <div class="mb-4 flex items-center justify-between">
        <span class="text-sm text-gray-500 dark:text-gray-400">
            Manage articles
        </span>

        <a
            href="{{ route('admin.articles.create') }}"
            class="inline-flex items-center gap-2
                   rounded-lg bg-btn-primary px-4 py-2
                   text-sm font-medium text-btn-text
                   hover:bg-btn-primary-hover transition"
        >
            + New Article
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th class="px-4 py-3 text-left">Thumbnail</th>
                    <th class="px-4 py-3 text-left">Title</th>
                    <th class="px-4 py-3 text-left">Excerpt</th>
                    <th class="px-4 py-3 text-left">Author</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Published At</th>
                    <th class="px-4 py-3 text-left">Created</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($articles as $article)
                    <tr class="border-b border-gray-100 dark:border-gray-800 align-top">

                        <!-- Thumbnail -->
                        <td class="px-4 py-3">
                            @if ($article->thumbnail)
                                <img
                                    src="{{ asset('storage/' . $article->thumbnail) }}"
                                    class="h-12 w-16 rounded object-cover"
                                    alt="Thumbnail"
                                >
                            @else
                                <span class="text-xs text-gray-400">No image</span>
                            @endif
                        </td>

                        <!-- Title -->
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800 dark:text-white/90">
                                {{ $article->title }}
                            </div>
                        </td>

                        <!-- Excerpt -->
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 max-w-xs">
                            {{ $article->excerpt ?? '-' }}
                        </td>

                        <!-- Author -->
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                            {{ $article->author ?? '-' }}
                        </td>

                        <!-- Status -->
                        <td class="px-4 py-3">
                            @if ($article->is_published)
                                <span
                                    class="inline-flex items-center rounded
                                           bg-green-100 px-2 py-1 text-xs
                                           text-green-700
                                           dark:bg-green-900/40 dark:text-green-400"
                                >
                                    Published
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center rounded
                                           bg-gray-200 px-2 py-1 text-xs
                                           text-gray-700
                                           dark:bg-gray-800 dark:text-gray-400"
                                >
                                    Draft
                                </span>
                            @endif
                        </td>

                        <!-- Published At -->
                        <td class="px-4 py-3 text-gray-500">
                            {{ $article->published_at?->format('d M Y H:i') ?? '-' }}
                        </td>

                        <!-- Created At -->
                        <td class="px-4 py-3 text-gray-500">
                            {{ $article->created_at->format('d M Y') }}
                        </td>

                        <!-- Action -->
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center gap-2">

                                <!-- Edit -->
                                <a
                                    href="{{ route('admin.articles.edit', $article) }}"
                                    class="inline-flex items-center justify-center
                                           rounded-md bg-btn-primary px-3 py-1.5
                                           text-xs font-medium text-btn-text
                                           hover:bg-btn-primary-hover transition"
                                >
                                    Edit
                                </a>

                                <!-- Delete -->
                                <form
                                    method="POST"
                                    action="{{ route('admin.articles.destroy', $article) }}"
                                    onsubmit="return confirm('Delete this article?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center justify-center
                                               rounded-md bg-danger px-3 py-1.5
                                               text-xs font-medium text-white
                                               hover:bg-danger/90 transition"
                                    >
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8"
                            class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            No articles found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $articles->links() }}
    </div>

</x-common.component-card>

@endsection
