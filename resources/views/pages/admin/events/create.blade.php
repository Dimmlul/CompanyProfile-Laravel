@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')

<x-common.component-card title="Create Event">

<form method="POST"
      action="{{ route('admin.events.store') }}"
      enctype="multipart/form-data">
@csrf

<div class="grid grid-cols-1 gap-5">

    {{-- TITLE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Title
        </label>
        <input
            type="text"
            name="title"
            value="{{ old('title') }}"
            required
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- DESCRIPTION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Short Description
        </label>
        <textarea
            name="description"
            rows="3"
            class="shadow-theme-xs w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-3 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
        >{{ old('description') }}</textarea>
    </div>

    {{-- CONTENT --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Content
        </label>
        <textarea
            name="content"
            rows="6"
            required
            class="shadow-theme-xs w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-3 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90"
        >{{ old('content') }}</textarea>
    </div>

    {{-- IMAGE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Event Image
        </label>
        <input
            type="file"
            name="image"
            accept="image/*"
            class="block w-full text-sm
                   file:mr-4 file:rounded-lg
                   file:border-0
                   file:bg-btn-primary
                   file:px-4 file:py-2
                   file:text-sm file:font-medium
                   file:text-btn-text
                   hover:file:bg-btn-primary-hover">
    </div>

    {{-- LOCATION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Location
        </label>
        <input
            type="text"
            name="location"
            value="{{ old('location') }}"
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- START DATE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Start Date
        </label>
        <input
            type="datetime-local"
            name="start_date"
            value="{{ old('start_date') }}"
            required
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- END DATE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
            End Date
        </label>
        <input
            type="datetime-local"
            name="end_date"
            value="{{ old('end_date') }}"
            class="shadow-theme-xs h-11 w-full rounded-lg
                   border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                   dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
    </div>

    {{-- STATUS (INI KRUSIAL) --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
            Status
        </label>

        {{-- fallback agar SELALU terkirim --}}
        <input type="hidden" name="is_active" value="0">

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

    {{-- SUBMIT --}}
    <div class="pt-3">
        <button
            type="submit"
            class="inline-flex items-center gap-2
                   rounded-lg bg-btn-primary px-5 py-2.5
                   text-sm font-medium text-btn-text
                   hover:bg-btn-primary-hover transition">
            Save Event
        </button>
    </div>

</div>
</form>

</x-common.component-card>

@endsection
