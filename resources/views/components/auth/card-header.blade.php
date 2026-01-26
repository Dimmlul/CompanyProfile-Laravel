<!-- resources/views/components/auth/card-header.blade.php -->
@props(['title', 'subtitle'])

<div class="mb-8 text-center">
    <h1 class="text-2xl font-semibold text-app-text">
        {{ $title }}
    </h1>
    <p class="mt-1 text-sm text-app-muted">
        {{ $subtitle }}
    </p>
</div>
