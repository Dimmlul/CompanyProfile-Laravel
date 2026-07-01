@props([
    'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10M4 7v10l8 4',
    'title',
    'description' => null,
])

{{-- Reusable empty state: icon + title + description, optional action via slot. --}}
<div class="surface flex flex-col items-center rounded-2xl px-6 py-16 text-center">
    <span class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-app-surface-2 text-app-muted">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
        </svg>
    </span>

    <p class="text-base font-semibold text-app-heading">{{ $title }}</p>

    @if ($description)
        <p class="mt-1 max-w-sm text-sm text-app-muted">{{ $description }}</p>
    @endif

    @if (trim($slot) !== '')
        <div class="mt-6">{{ $slot }}</div>
    @endif
</div>
