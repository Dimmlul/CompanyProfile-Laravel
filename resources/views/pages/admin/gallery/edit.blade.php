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

    {{-- CURRENT / PREVIEW IMAGE --}}
    <div x-data="{ preview: '{{ asset('storage/'.$gallery->image) }}' }">
        <label class="mb-1.5 block text-sm font-medium text-app-text">
            Image Preview
        </label>

        <img
            :src="preview"
            class="h-48 w-full rounded-lg object-cover
                   border border-[var(--color-border-soft)]"
        >

        {{-- CHANGE IMAGE --}}
        <div class="mt-3">
            <input
                type="file"
                name="image"
                accept="image/*"
                @change="
                    const file = $event.target.files[0];
                    if (file) preview = URL.createObjectURL(file)
                "
                class="block w-full text-sm
                       file:mr-4 file:rounded-lg
                       file:bg-brand-main
                       file:px-4 file:py-2
                       file:text-brand-text
                       hover:file:bg-brand-hover"
            >
        </div>

        <p class="mt-1 text-xs text-app-muted">
            Upload a new image to replace the current one
        </p>
    </div>

    {{-- TITLE --}}
    <x-common.form.input
        label="Title"
        name="title"
        :value="$gallery->title"
    />

    {{-- CAPTION --}}
    <x-common.form.textarea
        label="Caption"
        name="caption"
        :value="$gallery->caption"
        rows="3"
    />

    {{-- CATEGORY --}}
    <x-common.form.input
        label="Category"
        name="category"
        :value="$gallery->category"
    />

    {{-- ORDER POSITION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-app-text">
            Order Position
        </label>

        <select
            name="order_action"
            class="form-input"
        >
            <option value="">Keep current position</option>
            <option value="top">Move to top</option>
            <option value="up">Move up</option>
            <option value="down">Move down</option>
            <option value="bottom">Move to bottom</option>
        </select>

        <p class="mt-1 text-xs text-app-muted">
            Current order: {{ $gallery->order }}
        </p>
    </div>

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-app-text">
            Status
        </label>

        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input type="radio"
                       name="is_active"
                       value="1"
                       {{ $gallery->is_active ? 'checked' : '' }}>
                Active
            </label>

            <label class="flex items-center gap-2">
                <input type="radio"
                       name="is_active"
                       value="0"
                       {{ !$gallery->is_active ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="pt-2">
        <button
            type="submit"
            class="btn-primary"
        >
            Save Changes
        </button>
    </div>

</div>
</form>

</x-common.component-card>
@endsection
