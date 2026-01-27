@extends('layouts.admin')

@section('title', 'Create Article')

@section('content')

<x-common.component-card title="Create Article">

<form method="POST"
      action="{{ route('admin.articles.store') }}"
      enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-1 gap-5">

    <!-- Title -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Title
        </label>
        <input type="text"
               name="title"
               value="{{ old('title') }}"
               required
               class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    <!-- Excerpt -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Excerpt (optional)
        </label>
        <textarea name="excerpt" rows="3"
                  placeholder="Auto generated from content if empty"
                  class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                         border border-gray-300 bg-transparent px-4 py-3 text-sm
                         dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('excerpt') }}</textarea>
    </div>

    <!-- Content -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Content
        </label>
        <textarea name="content" rows="8" required
                  class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                         border border-gray-300 bg-transparent px-4 py-3 text-sm
                         dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('content') }}</textarea>
    </div>

    <!-- Thumbnail -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Thumbnail
        </label>
        <input type="file"
               name="thumbnail"
               accept="image/*"
               class="block w-full text-sm
                      file:mr-4 file:rounded-lg
                      file:bg-btn-primary
                      file:px-4 file:py-2
                      file:text-sm file:font-medium
                      file:text-btn-text
                      hover:file:bg-btn-primary-hover">
    </div>

    <!-- Author -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Author
        </label>
        <input type="text"
               name="author"
               value="{{ old('author', auth()->user()->name ?? '') }}"
               class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    <!-- Publish Date -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Publish Date
        </label>
        <input type="datetime-local"
               name="published_at"
               value="{{ old('published_at') }}"
               class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    <!-- Publish Status -->
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Publish Status
        </label>
        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_published" value="1">
                Publish
            </label>

            <label class="flex items-center gap-2">
                <input type="radio" name="is_published" value="0" checked>
                Draft
            </label>
        </div>
    </div>

    <!-- Submit -->
    <button class="rounded-lg bg-btn-primary px-5 py-2.5
                   text-sm font-medium text-btn-text
                   hover:bg-btn-primary-hover transition">
        Save Article
    </button>

</div>
</form>

</x-common.component-card>

@endsection
