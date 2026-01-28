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
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            Title
        </label>
        <input type="text" name="title" required
               class="h-11 w-full rounded-lg
                      border border-card-border
                      bg-input-bg px-4 text-sm text-app-text">
    </div>

    {{-- DESCRIPTION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            Short Description
        </label>
        <textarea name="description" rows="3"
                  class="w-full rounded-lg
                         border border-card-border
                         bg-input-bg px-4 py-3 text-sm text-app-text"></textarea>
    </div>

    {{-- CONTENT --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            Content
        </label>
        <textarea name="content" rows="6" required
                  class="w-full rounded-lg
                         border border-card-border
                         bg-input-bg px-4 py-3 text-sm text-app-text"></textarea>
    </div>

    {{-- IMAGE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            Image
        </label>
        <input type="file" name="image"
               class="block w-full text-sm
                      file:rounded-lg file:bg-btn-primary
                      file:px-4 file:py-2 file:text-btn-text">
    </div>

    {{-- LOCATION --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            Location
        </label>
        <input type="text" name="location"
               class="h-11 w-full rounded-lg
                      border border-card-border
                      bg-input-bg px-4 text-sm text-app-text">
    </div>

    {{-- START DATE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            Start Date
        </label>
        <input type="datetime-local" name="start_date" required
               class="h-11 w-full rounded-lg
                      border border-card-border
                      bg-input-bg px-4 text-sm text-app-text">
    </div>

    {{-- END DATE --}}
    <div>
        <label class="mb-1.5 block text-sm font-medium text-text-muted">
            End Date
        </label>
        <input type="datetime-local" name="end_date"
               class="h-11 w-full rounded-lg
                      border border-card-border
                      bg-input-bg px-4 text-sm text-app-text">
    </div>

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-text-muted">
            Status
        </label>

        <input type="hidden" name="is_active" value="0">

        <div class="flex gap-6 text-sm text-app-text">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1" checked>
                Active
            </label>
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0">
                Inactive
            </label>
        </div>
    </div>

    {{-- SUBMIT --}}
    <button class="btn-primary w-fit">
        Save Event
    </button>

</div>
</form>

</x-common.component-card>

@endsection
