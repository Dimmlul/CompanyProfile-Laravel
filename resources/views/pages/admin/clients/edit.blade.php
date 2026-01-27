@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')

<x-common.component-card title="Edit Client">

<form method="POST"
      action="{{ route('admin.clients.update', $client) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="grid grid-cols-1 gap-5">

    {{-- NAME --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Client Name
        </label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $client->name) }}"
            required
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- CURRENT LOGO --}}
    @if ($client->logo)
        <div>
            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                Current Logo
            </label>
            <img
                src="{{ asset('storage/'.$client->logo) }}"
                class="h-24 rounded-lg border border-gray-300 dark:border-gray-700 object-contain">
        </div>
    @endif

    {{-- LOGO --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Change Logo
        </label>
        <input
            type="file"
            name="logo"
            accept="image/*"
            class="block w-full text-sm
                   file:rounded-lg
                   file:bg-btn-primary
                   file:px-4 file:py-2
                   file:text-btn-text
                   hover:file:bg-btn-primary-hover">
    </div>

    {{-- WEBSITE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Website
        </label>
        <input
            type="url"
            name="website"
            value="{{ old('website', $client->website) }}"
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- DESCRIPTION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Description
        </label>
        <textarea
            name="description"
            rows="3"
            class="shadow-theme-xs w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-3 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
        >{{ old('description', $client->description) }}</textarea>
    </div>

    {{-- ORDER --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Order
        </label>
        <input
            type="number"
            name="order"
            value="{{ old('order', $client->order) }}"
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Status
        </label>

        {{-- fallback --}}
        <input type="hidden" name="is_active" value="0">

        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $client->is_active) ? 'checked' : '' }}>
                Active
            </label>

            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="is_active"
                    value="0"
                    {{ !old('is_active', $client->is_active) ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="pt-3">
        <button
            type="submit"
            class="rounded-lg bg-btn-primary px-5 py-2.5
                   text-sm font-medium text-btn-text
                   hover:bg-btn-primary-hover transition">
            Update Client
        </button>
    </div>

</div>
</form>

</x-common.component-card>

@endsection
