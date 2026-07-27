{{-- A simple "Back" link button, used to return to a previous admin page. --}}

@props([
    'href'
])

<a href="{{ $href }}" class="btn-admin">
    Back
</a>
