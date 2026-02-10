@props([
    'label' => 'Save'
])

<div class="mt-6 flex justify-end gap-3">
    <button
        type="submit"
        :disabled="!isValid()"
        class="btn-primary
               disabled:opacity-50
               disabled:cursor-not-allowed"
    >
        {{ $label }}
    </button>
</div>
