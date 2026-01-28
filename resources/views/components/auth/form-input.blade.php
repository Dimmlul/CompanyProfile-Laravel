@props([
    'label',
    'name',
    'type' => 'text',
    'placeholder' => '',
])

<div>
    <label class="mb-1.5 block text-sm font-medium text-app-text">
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
                bg-slate-900/60
                border border-white/10
                px-4 text-app-text
                placeholder:text-app-muted
                outline-none
                focus:border-brand
                focus:ring-2 focus:ring-brand/40
                transition
            '
        ]) }}
    />

    @error($name)
        <p class="mt-1 text-sm text-danger">{{ $message }}</p>
    @enderror
</div>
