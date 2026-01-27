<!-- resources/views/pages/admin/articles/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Article')

@section('content')

<x-common.component-card title="Edit Article">

    <form
        method="POST"
        action="{{ route('admin.articles.update', $article) }}"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-5">

            <!-- Title -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Title
                </label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $article->title) }}"
                    required
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                />
            </div>

            <!-- Excerpt -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Excerpt
                </label>
                <textarea
                    name="excerpt"
                    rows="3"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <!-- Content -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Content
                </label>
                <textarea
                    name="content"
                    rows="8"
                    required
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >{{ old('content', $article->content) }}</textarea>
            </div>

            <!-- Thumbnail -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Thumbnail
                </label>

                @if ($article->thumbnail)
                    <div class="mb-3">
                        <img
                            src="{{ asset('storage/' . $article->thumbnail) }}"
                            class="h-24 rounded border border-gray-300 dark:border-gray-700 object-cover"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    name="thumbnail"
                    accept="image/*"
                    class="block w-full text-sm text-gray-700 dark:text-gray-300
                           file:mr-4 file:rounded-lg file:border-0
                           file:bg-gray-200 file:px-4 file:py-2
                           file:text-sm file:font-medium
                           hover:file:bg-gray-300
                           dark:file:bg-gray-800 dark:hover:file:bg-gray-700"
                >
            </div>

            <!-- Author -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Author
                </label>
                <input
                    type="text"
                    name="author"
                    value="{{ old('author', $article->author) }}"
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                />
            </div>

            <!-- Publish Date -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Publish Date
                </label>
                <input
                    type="datetime-local"
                    name="published_at"
                    value="{{ old(
                        'published_at',
                        optional($article->published_at)->format('Y-m-d\TH:i')
                    ) }}"
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90"
                />
            </div>

            <!-- Publish Status -->
            <div>
                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Publish Status
                </label>

                <div class="flex items-center gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="is_published"
                            value="1"
                            {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                            class="text-brand-500 focus:ring-brand-500/20"
                        >
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Published
                        </span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="radio"
                            name="is_published"
                            value="0"
                            {{ !old('is_published', $article->is_published) ? 'checked' : '' }}
                            class="text-brand-500 focus:ring-brand-500/20"
                        >
                        <span class="text-sm text-gray-700 dark:text-gray-300">
                            Draft
                        </span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-3">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           rounded-lg bg-btn-primary px-5 py-2.5
                           text-sm font-medium text-btn-text
                           hover:bg-btn-primary-hover transition"
                >
                    Update Article
                </button>
            </div>

        </div>
    </form>

</x-common.component-card>

@endsection
