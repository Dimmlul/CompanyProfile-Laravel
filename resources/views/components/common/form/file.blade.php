@props([
    'label',
    'name',
])

{{-- Labeled file input with a branded "choose file" button. --}}
<div class="space-y-1.5">
    <label for="{{ $name }}" class="block text-sm font-medium text-app-heading">
        {{ $label }}
        @if ($attributes->get('required')) <span class="text-danger">*</span> @endif
    </label>

    <input
        id="{{ $name }}"
        type="file"
        name="{{ $name }}"
        {{ $attributes->class('block w-full text-sm text-app-muted
               file:mr-3 file:rounded-lg file:border-0
               file:bg-brand-main file:px-4 file:py-2
               file:text-sm file:font-medium file:text-white
               hover:file:bg-brand-hover') }}
    >

    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
