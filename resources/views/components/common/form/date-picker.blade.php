{{-- resources/views/components/common/form/date-picker.blade.php --}}

@props([
    'label',
    'name',
    'value' => null,
])

@php
    $formatted = null;

    if ($value instanceof \Carbon\Carbon) {
        $formatted = $value->format('Y-m-d\TH:i');
    } elseif (is_string($value) && $value !== '') {
        $formatted = $value;
    }
@endphp

<div class="space-y-2">
    {{-- LABEL --}}
    <label class="block text-sm font-medium text-app-text">
        {{ $label }}
    </label>

    {{-- INPUT WRAPPER --}}
    <div
        x-data="{ val: '{{ old($name, $formatted) }}' }"
        class="relative"
    >
        {{-- INPUT --}}
        <input
            x-ref="input"
            type="datetime-local"
            name="{{ $name }}"
            :value="val"
            @input="val = $event.target.value"
            class="form-input h-11 pr-20"
        >

        {{-- ICON WRAPPER (INSIDE INPUT) --}}
        <div class="absolute inset-y-0 right-3 flex items-center gap-2">

            {{-- CALENDAR --}}
            <button
                type="button"
                @click="$refs.input.showPicker
                    ? $refs.input.showPicker()
                    : $refs.input.focus()"
                class="text-app-muted hover:text-app-text transition"
                tabindex="-1"
                title="Pick date"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14
                             a2 2 0 002-2V7
                             a2 2 0 00-2-2H5
                             a2 2 0 00-2 2v12
                             a2 2 0 002 2z"/>
                </svg>
            </button>

            {{-- CLEAR --}}
            <button
                type="button"
                x-show="val"
                @click="val = ''"
                class="text-app-muted hover:text-app-text transition"
                tabindex="-1"
                title="Clear"
            >
                ✕
            </button>
        </div>
    </div>

    {{-- ERROR --}}
    @error($name)
        <p class="text-xs text-red-500">{{ $message }}</p>
    @enderror
</div>
