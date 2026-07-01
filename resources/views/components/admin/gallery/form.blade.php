@props([
    'gallery' => null,
    'action',
    'method' => 'POST',
])

{{-- Gallery item form, shared by create, edit and the quick-add modal. --}}
<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid grid-cols-1 gap-5">
        <x-common.form.input label="Title" name="title" :value="$gallery?->title" required />
        <x-common.form.input label="Category" name="category" :value="$gallery?->category" placeholder="e.g. Projects, Events" />
        <x-common.form.textarea label="Caption" name="caption" rows="3" :value="$gallery?->caption" />
        <x-common.form.file label="Image" name="image" />

        @if ($gallery?->image)
            <img src="{{ asset('storage/'.$gallery->image) }}" class="h-24 rounded-lg border border-app-border object-cover">
        @endif

        <x-common.form.radio-group
            label="Status"
            name="is_active"
            :value="$gallery?->is_active ?? 1"
            :options="[1 => 'Active', 0 => 'Inactive']"
        />

        <div class="pt-2">
            <button class="btn-primary">{{ $method === 'POST' ? 'Save Image' : 'Update Image' }}</button>
        </div>
    </div>
</form>
