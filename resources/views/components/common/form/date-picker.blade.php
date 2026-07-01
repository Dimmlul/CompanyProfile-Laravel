@props([
    'label',
    'name',
    'value' => null,
])

@php
    // Normalise the value to the datetime-local input format.
    $formatted = $value instanceof \Carbon\Carbon
        ? $value->format('Y-m-d\TH:i')
        : (is_string($value) ? $value : null);
@endphp

{{-- Labeled datetime field (uses the browser's native date/time picker). --}}
<div class="space-y-1.5">
    <label for="{{ $name }}" class="block text-sm font-medium text-app-heading">{{ $label }}</label>

    <input
        id="{{ $name }}"
        type="datetime-local"
        name="{{ $name }}"
        value="{{ old($name, $formatted) }}"
        {{ $attributes->class('form-input') }}
    >

    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
