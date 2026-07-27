{{-- Standard form submit button with a customizable label. --}}

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
