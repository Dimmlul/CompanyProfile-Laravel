@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')

<x-common.component-card title="Edit Event">

<form method="POST"
      action="{{ route('admin.events.update', $event) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="grid grid-cols-1 gap-6">

    {{-- TITLE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-app-muted">
            Title
        </label>
        <input type="text"
               name="title"
               value="{{ old('title', $event->title) }}"
               required
               class="h-11 w-full rounded-lg
                      bg-input-bg text-app-text
                      border border-input-border
                      px-4 text-sm
                      focus:border-btn-primary focus:ring-0">
    </div>

    {{-- DESCRIPTION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-app-muted">
            Short Description
        </label>
        <textarea name="description" rows="3"
                  class="w-full rounded-lg
                         bg-input-bg text-app-text
                         border border-input-border
                         px-4 py-3 text-sm
                         focus:border-btn-primary focus:ring-0">{{ old('description', $event->description) }}</textarea>
    </div>

    {{-- CONTENT --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-app-muted">
            Content
        </label>
        <textarea name="content" rows="6" required
                  class="w-full rounded-lg
                         bg-input-bg text-app-text
                         border border-input-border
                         px-4 py-3 text-sm
                         focus:border-btn-primary focus:ring-0">{{ old('content', $event->content) }}</textarea>
    </div>

    {{-- CURRENT IMAGE --}}
    @if ($event->image)
        <div>
            <label class="mb-2 block text-sm font-medium text-app-muted">
                Current Image
            </label>
            <img src="{{ asset('storage/'.$event->image) }}"
                 class="h-40 rounded-lg border border-card-border object-cover">
        </div>
    @endif

    {{-- IMAGE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-app-muted">
            Change Image
        </label>
        <input type="file"
               name="image"
               class="block w-full text-sm
                      file:rounded-lg
                      file:bg-btn-primary
                      file:px-4 file:py-2
                      file:text-btn-text
                      hover:file:bg-btn-primary-hover">
    </div>

    {{-- LOCATION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-app-muted">
            Location
        </label>
        <input type="text"
               name="location"
               value="{{ old('location', $event->location) }}"
               class="h-11 w-full rounded-lg
                      bg-input-bg text-app-text
                      border border-input-border
                      px-4 text-sm
                      focus:border-btn-primary focus:ring-0">
    </div>

    {{-- DATES --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="mb-1.5 block text-sm font-medium text-app-muted">
                Start Date
            </label>
            <input type="datetime-local"
                   name="start_date"
                   value="{{ old('start_date', $event->start_date?->format('Y-m-d\TH:i')) }}"
                   class="h-11 w-full rounded-lg
                          bg-input-bg text-app-text
                          border border-input-border
                          px-4 text-sm
                          focus:border-btn-primary focus:ring-0">
        </div>

        <div>
            <label class="mb-1.5 block text-sm font-medium text-app-muted">
                End Date
            </label>
            <input type="datetime-local"
                   name="end_date"
                   value="{{ old('end_date', $event->end_date?->format('Y-m-d\TH:i')) }}"
                   class="h-11 w-full rounded-lg
                          bg-input-bg text-app-text
                          border border-input-border
                          px-4 text-sm
                          focus:border-btn-primary focus:ring-0">
        </div>
    </div>

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-app-muted">
            Status
        </label>

        <input type="hidden" name="is_active" value="0">

        <div class="flex gap-6 text-sm text-app-text">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1"
                    {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0"
                    {{ !old('is_active', $event->is_active) ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="pt-2">
        <button class="btn-primary">
            Update Event
        </button>
    </div>

</div>
</form>

</x-common.component-card>

@endsection
