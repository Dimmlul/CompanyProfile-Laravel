@props([
    'label',
    'name',
    'options' => [],
    'value' => null,
])

<div class="space-y-2">
    <label class="text-xs font-medium text-app-muted">
        {{ $label }}
    </label>

    <div class="flex gap-6 text-sm text-app-text">
        @foreach ($options as $val => $text)
            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="radio"
                    name="{{ $name }}"
                    value="{{ $val }}"
                    {{ (string)old($name, $value) === (string)$val ? 'checked' : '' }}
                    class="text-brand-500 focus:ring-brand-500/30"
                >
                {{ $text }}
            </label>
        @endforeach
    </div>
</div>
