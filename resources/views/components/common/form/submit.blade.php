<!-- resources/views/components/common/form/submit.blade.php -->

@props([
    'label' => 'Save'
])

<div class="pt-4">
    <button
        type="submit"
        class="btn-primary"
    >
        {{ $label }}
    </button>
</div>
