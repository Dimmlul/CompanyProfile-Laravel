<!-- resources/views/components/admin/dashboard/stat-card.blade.php -->

@props([
    'title',
    'subtitle',
    'value',
])

<div class="rounded-2xl border border-white/10 bg-white/5 p-6 space-y-5">

    {{-- HEADER --}}
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center
                        rounded-xl bg-white/10 text-lg">
                {{ $icon ?? '📊' }}
            </div>

            <div>
                <p class="text-sm font-medium text-app-text">
                    {{ $title }}
                </p>
                <p class="text-xs text-app-muted">
                    {{ $subtitle }}
                </p>
            </div>
        </div>

        {{ $viewAll ?? '' }}
    </div>

    {{-- VALUE + ACTION --}}
    <div class="flex items-center justify-between">
        <p class="text-3xl font-semibold text-app-text">
            {{ $value }}
        </p>

        {{ $action ?? '' }}
    </div>

</div>
