@props([
    'label',
    'name',
    'options' => [],
    'value' => null,
])

{{-- Labeled inline radio group. $options is [value => label]. --}}
<div class="space-y-2">
    <label class="block text-sm font-medium text-app-heading">{{ $label }}</label>

    <div class="flex flex-wrap gap-6 text-sm text-app-text">
        @foreach ($options as $val => $text)
            <label class="flex cursor-pointer items-center gap-2">
                <input
                    type="radio"
                    name="{{ $name }}"
                    value="{{ $val }}"
                    @checked((string) old($name, $value) === (string) $val)
                    class="h-4 w-4 accent-[var(--color-brand-main)]"
                >
                {{ $text }}
            </label>
        @endforeach
    </div>

    @error($name)
        <p class="mt-1 text-xs text-danger">{{ $message }}</p>
    @enderror
</div>
