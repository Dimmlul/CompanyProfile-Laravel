@props([
    'label',
    'name',
    'value' => null,
    'rows' => 4,
    'placeholder' => null,
])

<div class="space-y-1">

    {{-- LABEL --}}
    <label class="text-sm font-medium text-app-muted">
        {{ $label }}
    </label>

    {{-- WRAPPER --}}
    <div class="relative">

        {{-- TEXTAREA --}}
        <textarea
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            class="form-input pr-6 resize-y pt-3"
        >{{ old($name, $value) }}</textarea>

        {{-- CLEAR BUTTON --}}
        <button
            type="button"
            onclick="this.previousElementSibling.value=''"
            class="absolute top-3 right-3
                   text-app-muted hover:text-app-text
                   text-sm"
            title="Clear"
        >
            ✕
        </button>

    </div>

    {{-- ERROR --}}
    @error($name)
        <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror

</div>

