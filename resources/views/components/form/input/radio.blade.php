@props([
    'id',
    'name',
    'value',
    'checked' => false,
    'label',
    'disabled' => false,
])

<label for="{{ $id }}"
    @class([
        'relative flex cursor-pointer select-none items-center gap-3 text-sm font-medium',
        'text-gray-300 dark:text-gray-600 cursor-not-allowed' => $disabled,
        'text-gray-700 dark:text-gray-400' => !$disabled,
        $attributes->get('class'),
    ])>
    
    <input 
        id="{{ $id }}"
        name="{{ $name }}"
        type="radio"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        class="sr-only"
        {{ $attributes->except(['class', 'label']) }}
    />
    
    <span @class([
        'flex h-5 w-5 items-center justify-center rounded-full border-[1.25px]',
        'border-brand-500 bg-brand-500' => $checked && !$disabled,
        'bg-transparent border-gray-300 dark:border-gray-700' => !$checked && !$disabled,
        'bg-gray-100 dark:bg-gray-700 border-gray-200 dark:border-gray-700' => $disabled,
    ])>
        <span @class([
            'h-2 w-2 rounded-full bg-white',
            'block' => $checked,
            'hidden' => !$checked,
        ])></span>
    </span>
    
    {{ $label }}
</label>