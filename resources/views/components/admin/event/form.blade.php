@props([
    'action',
    'method' => 'POST',
    'event' => null,
])

<form
    method="POST"
    action="{{ $action }}"
    enctype="multipart/form-data"
>
@csrf
@if ($method !== 'POST')
    @method($method)
@endif

<div class="grid grid-cols-1 gap-5">

    {{-- TITLE --}}
    <x-common.form.input
        label="Title"
        name="title"
        :value="old('title', $event->title ?? '')"
        required
    />

    {{-- SHORT DESCRIPTION --}}
    <x-common.form.textarea
        label="Short Description"
        name="description"
        rows="3"
        :value="old('description', $event->description ?? '')"
    />

    {{-- CONTENT --}}
    <x-common.form.textarea
        label="Content"
        name="content"
        rows="6"
        :value="old('content', $event->content ?? '')"
        required
    />

    {{-- IMAGE --}}
    <div>
        <label class="text-sm font-medium text-app-text">
            Image
        </label>

        @if (!empty($event?->image))
            <div class="mb-3">
                <img
                    src="{{ asset('storage/'.$event->image) }}"
                    class="h-32 rounded-lg border border-white/10 object-cover"
                >
            </div>
        @endif

        <input type="file" name="image" class="form-input">
    </div>

    {{-- LOCATION --}}
    <x-common.form.input
        label="Location"
        name="location"
        :value="old('location', $event->location ?? '')"
    />

    {{-- DATES --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <x-common.form.date-picker
            label="Start Date"
            name="start_date"
            :value="old(
                'start_date',
                optional($event->start_date ?? null)->format('Y-m-d\TH:i')
            )"
        />

        <x-common.form.date-picker
            label="End Date"
            name="end_date"
            :value="old(
                'end_date',
                optional($event->end_date ?? null)->format('Y-m-d\TH:i')
            )"
        />

    </div>

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-app-text">
            Status
        </label>

        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $event->is_active ?? 1) ? 'checked' : '' }}
                >
                Active
            </label>

            <label class="flex items-center gap-2">
                <input
                    type="radio"
                    name="is_active"
                    value="0"
                    {{ !old('is_active', $event->is_active ?? 1) ? 'checked' : '' }}
                >
                Inactive
            </label>
        </div>
    </div>

    {{-- SUBMIT --}}
    <x-common.form.submit
        :label="$method === 'POST' ? 'Save Event' : 'Update Event'"
    />

</div>
</form>
