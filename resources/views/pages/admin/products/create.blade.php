@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')

<x-common.component-card title="Create Product">

<form method="POST"
      action="{{ route('admin.products.store') }}"
      enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-1 gap-5">

    {{-- Name --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Product Name
        </label>
        <input type="text"
               name="name"
               value="{{ old('name') }}"
               required
               class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Description --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Short Description
        </label>
        <textarea name="description" rows="3"
                  class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                         border border-gray-300 bg-transparent px-4 py-3 text-sm
                         dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('description') }}</textarea>
    </div>

    {{-- Content --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Product Content
        </label>
        <textarea name="content" rows="6" required
                  class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                         border border-gray-300 bg-transparent px-4 py-3 text-sm
                         dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">{{ old('content') }}</textarea>
    </div>

    {{-- Image --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Product Image
        </label>
        <input type="file"
               name="image"
               class="block w-full text-sm
                      file:rounded-lg file:bg-btn-primary
                      file:px-4 file:py-2 file:text-btn-text
                      hover:file:bg-btn-primary-hover">
    </div>

    {{-- Price --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Price
        </label>
        <input type="number"
               name="price"
               value="{{ old('price') }}"
               required
               class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Order --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Display Order
        </label>
        <input type="number"
               name="order"
               value="{{ old('order', 0) }}"
               class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- Status --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Status
        </label>

        {{-- fallback --}}
        <input type="hidden" name="is_active" value="0">

        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1">
                Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0" checked>
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
        Save Product
    </button>

</div>
</form>

</x-common.component-card>

@endsection
