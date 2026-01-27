<!-- resources/views/pages/admin/gallery/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Gallery')

@section('content')

<x-common.component-card title="Edit Gallery Image">

<form method="POST"
      action="{{ route('admin.gallery.update', $gallery) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="grid grid-cols-1 gap-5">

    {{-- Title --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Title
        </label>
        <input type="text" name="title"
               value="{{ old('title', $gallery->title) }}"
               class="shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Current Image --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Current Image
        </label>

        <img src="{{ asset('storage/'.$gallery->image) }}"
             class="mb-3 h-32 rounded-lg border border-gray-300 dark:border-gray-700 object-cover">

        <input type="file" name="image"
               class="block w-full text-sm
                      file:rounded-lg file:bg-btn-primary
                      file:px-4 file:py-2 file:text-btn-text
                      hover:file:bg-btn-primary-hover">
    </div>

    {{-- Caption --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Caption
        </label>
        <textarea name="caption" rows="3"
                  class="shadow-theme-xs w-full rounded-lg
                         border border-gray-300 bg-transparent px-4 py-3 text-sm
                         dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('caption', $gallery->caption) }}</textarea>
    </div>

    {{-- Category --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Category
        </label>
        <input type="text" name="category"
               value="{{ old('category', $gallery->category) }}"
               class="shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Order --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Order
        </label>
        <input type="number" name="order"
               value="{{ old('order', $gallery->order) }}"
               class="shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Status --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Status
        </label>
        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1"
                       {{ $gallery->is_active ? 'checked' : '' }}>
                Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0"
                       {{ !$gallery->is_active ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    {{-- Submit --}}
    <button
        class="rounded-lg bg-btn-primary px-5 py-2.5
               text-sm font-medium text-btn-text
               hover:bg-btn-primary-hover transition">
        Update Image
    </button>

</div>
</form>

</x-common.component-card>

@endsection
