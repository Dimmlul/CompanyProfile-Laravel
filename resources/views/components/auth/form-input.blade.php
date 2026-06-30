@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
])

<div>
    <label class="mb-1.5 block text-sm font-medium text-app-heading">
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
                bg-transparent
                border border-app-border
                px-4 text-app-heading
                placeholder:text-app-muted
                outline-none
                focus:border-brand-main
                focus:ring-2 focus:ring-brand-main/30
                transition
            '
        ]) }}
    />

    @error($name)
        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
    @enderror
</div>
