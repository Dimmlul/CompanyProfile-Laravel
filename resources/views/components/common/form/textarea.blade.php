@props([
    'label',
    'name',
    'value' => null,
    'rows' => 4,
])

{{-- Labeled textarea with validation error. --}}
<div class="space-y-1.5">
    <label for="{{ $name }}" class="block text-sm font-medium text-app-heading">{{ $label }}</label>

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->class('form-input resize-y') }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
