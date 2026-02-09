@props([
    'action',
    'method' => 'POST',
    'gallery' => null,
])

<form method="POST"
      action="{{ $action }}"
      enctype="multipart/form-data">
@csrf
@if ($method !== 'POST')
    @method($method)
@endif

<div class="grid grid-cols-1 gap-5">

    <x-common.form.input
        label="Title"
        name="title"
        :value="old('title', $gallery->title ?? '')"
    />

    {{-- IMAGE --}}
    <div>
        <label class="text-sm font-medium text-app-text">
            Image
        </label>

        @if (!empty($gallery?->image))
            <img
                src="{{ asset('storage/'.$gallery->image) }}"
                class="mb-3 h-32 rounded-lg border border-white/10 object-cover"
            >
        @endif

        <input type="file" name="image" class="form-input">
    </div>

    <x-common.form.textarea
        label="Caption"
        name="caption"
        rows="3"
        :value="old('caption', $gallery->caption ?? '')"
    />

    <x-common.form.input
        label="Category"
        name="category"
        :value="old('category', $gallery->category ?? '')"
    />

    <x-common.form.input
        label="Order"
        name="order"
        type="number"
        :value="old('order', $gallery->order ?? '')"
    />

    {{-- STATUS --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-app-text">
            Status
        </label>

        <div class="flex gap-6 text-sm">
            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="1"
                    {{ old('is_active', $gallery->is_active ?? 1) ? 'checked' : '' }}>
                Active
            </label>

            <label class="flex items-center gap-2">
                <input type="radio" name="is_active" value="0"
                    {{ !old('is_active', $gallery->is_active ?? 1) ? 'checked' : '' }}>
                Inactive
            </label>
        </div>
    </div>

    <x-common.form.submit
        :label="$method === 'POST' ? 'Save Image' : 'Update Image'"
    />

</div>
</form>
