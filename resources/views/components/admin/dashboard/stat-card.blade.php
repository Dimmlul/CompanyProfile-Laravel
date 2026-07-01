@props([
    'title',
    'subtitle',
    'value',
])

<div class="surface surface-hover rounded-2xl p-6">

    {{-- HEADER --}}
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-3">
            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-brand-soft text-brand-accent">
                {{ $icon }}
            </span>
            <div>
                <p class="text-sm font-medium text-app-heading">{{ $title }}</p>
                <p class="text-xs text-app-muted">{{ $subtitle }}</p>
            </div>
        </div>

        {{ $viewAll ?? '' }}
    </div>

    {{-- VALUE + ACTION --}}
    <div class="mt-6 flex items-end justify-between">
        <p class="text-3xl font-semibold tracking-tight text-app-heading">{{ $value }}</p>
        {{ $action ?? '' }}
    </div>
</div>
