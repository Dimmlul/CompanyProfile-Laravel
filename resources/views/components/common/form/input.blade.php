@props([
    'label',
    'name',
    'value' => '',
    'type' => 'text',
    'placeholder' => null,
])

<div class="space-y-2">
    <label class="block text-sm font-medium text-app-text">
        {{ $label }}
    </label>

    <div
        x-data="{ val: @js(old($name, $value)) }"
        class="relative"
    >
        <input
            x-model="val"
            type="{{ $type }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            class="form-input pr-10"
        >

        {{-- CLEAR BUTTON --}}
        <button
            type="button"
            x-show="val !== ''"
            @click="val = ''"
            class="absolute right-3 top-1/2 -translate-y-1/2
                   text-app-muted hover:text-app-text
                   transition"
            tabindex="-1"
        >
            ✕
        </button>
    </div>

    @error($name)
        <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
