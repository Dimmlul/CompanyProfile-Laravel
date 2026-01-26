<!-- resources/views/components/auth/form-input.blade.php -->
@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
])

<div>
    <label class="mb-1 block text-sm font-medium text-app-text">
        {{ $label }}
        <span class="text-danger">*</span>
    </label>

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge([
            'class' => '
                h-11 w-full rounded-lg
                bg-input-bg
                border border-input-border
                px-4 text-app-text
                placeholder:text-input-placeholder
                focus:border-btn-primary
                focus:ring-btn-primary
            '
        ]) }}
    />

    @error($name)
        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
    @enderror
</div>
