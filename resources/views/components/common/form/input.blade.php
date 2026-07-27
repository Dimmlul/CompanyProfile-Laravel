@props([
    'label',
    'name',
    'value' => '',
    'type' => 'text',
])

{{-- Labeled text input. Extra attributes (placeholder, required, min, step...) pass through. --}}
<div class="space-y-1.5">
    <label for="{{ $name }}" class="block text-sm font-medium text-app-heading">
        {{ $label }}
        @if ($attributes->get('required')) <span class="text-danger">*</span> @endif
    </label>

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->class('form-input') }}
    >

    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
