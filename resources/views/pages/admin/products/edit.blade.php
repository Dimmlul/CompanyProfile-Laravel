<!-- resources/views/pages/admin/products/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<x-common.component-card title="Edit Product">

<form method="POST"
      action="{{ route('admin.products.update', $product) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="grid grid-cols-1 gap-5">

    <!-- Name -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Product Name
        </label>
        <input type="text" name="name"
            value="{{ old('name', $product->name) }}"
            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                   focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                   dark:text-white/90"
            required>
    </div>

    <!-- Description -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Short Description
        </label>
        <textarea name="description" rows="3"
            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-3 text-sm
                   focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                   focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                   dark:text-white/90">{{ old('description', $product->description) }}</textarea>
    </div>

    <!-- Content -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Product Content
        </label>
        <textarea name="content" rows="6"
            class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-3 text-sm
                   focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                   focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                   dark:text-white/90"
            required>{{ old('content', $product->content) }}</textarea>
    </div>

    <!-- Image -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Product Image
        </label>

        @if ($product->image)
            <img src="{{ asset('storage/'.$product->image) }}"
                 class="mb-2 h-24 rounded object-cover">
        @endif

        <input type="file" name="image"
            class="block w-full text-sm text-gray-700
                   file:mr-4 file:rounded-lg file:border-0
                   file:bg-btn-primary file:px-4 file:py-2
                   file:text-sm file:font-medium file:text-btn-text
                   hover:file:bg-btn-primary-hover">
    </div>

    <!-- Price -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Price
        </label>
        <input type="number" name="price"
            value="{{ old('price', $product->price) }}"
            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                   focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                   dark:text-white/90"
            required>
    </div>

    <!-- Order -->
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Display Order
        </label>
        <input type="number" name="order"
            value="{{ old('order', $product->order) }}"
            class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                   focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                   dark:text-white/90">
    </div>

    <!-- Status -->
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Status
        </label>
        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1"
                       {{ $product->is_active ? 'checked' : '' }}>
                Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0"
                       {{ !$product->is_active ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    <!-- Submit -->
    <div class="pt-3">
        <button
            class="inline-flex items-center gap-2
                   rounded-lg bg-btn-primary px-5 py-2.5
                   text-sm font-medium text-btn-text
                   hover:bg-btn-primary-hover transition">
            Update Product
        </button>
    </div>

</div>
</form>

</x-common.component-card>

@endsection
