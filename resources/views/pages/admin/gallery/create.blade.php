@extends('layouts.admin')

@section('title', 'Add Gallery')

@section('content')

<x-common.component-card title="Add Gallery Image">

<form method="POST"
      action="{{ route('admin.gallery.store') }}"
      enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-1 gap-5">

    {{-- Title --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Title
        </label>
        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Image --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Image
        </label>
        <input
            type="file"
            name="image"
            required
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
        <textarea
            name="caption"
            rows="3"
            class="shadow-theme-xs w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-3 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('caption') }}</textarea>
    </div>

    {{-- Category --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Category
        </label>
        <input
            type="text"
            name="category"
            value="{{ old('category') }}"
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Order --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Order
        </label>
        <input
            type="number"
            name="order"
            value="{{ old('order', 0) }}"
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
                <input
                    type="radio"
                    name="is_active"
                    value="1"
                    {{ old('is_active', '1') === '1' ? 'checked' : '' }}>
                Active
            </label>

            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="is_active"
                    value="0"
                    {{ old('is_active') === '0' ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    {{-- Submit --}}
    <button
        type="submit"
        class="rounded-lg bg-btn-primary px-5 py-2.5
               text-sm font-medium text-btn-text
               hover:bg-btn-primary-hover transition">
        Save Image
    </button>

</div>
</form>

</x-common.component-card>

@endsection
