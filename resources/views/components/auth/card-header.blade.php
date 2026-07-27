{{-- Auth card title block. --}}
@props(['title', 'subtitle'])

<div class="mb-8 text-center">
    <h1 class="text-2xl font-semibold text-app-heading">
        {{ $title }}
    </h1>
    <p class="mt-2 text-sm text-app-muted">
        {{ $subtitle }}
    </p>
</div>
