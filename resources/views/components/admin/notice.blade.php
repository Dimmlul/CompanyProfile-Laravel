{{-- Reusable inline notice for admin forms (info or warning tone). --}}
@props(['type' => 'info'])

@php
    $styles = [
        'info'    => 'border-blue-500/30 bg-blue-500/10 text-blue-700 dark:text-blue-300',
        'warning' => 'border-yellow-500/30 bg-yellow-500/10 text-yellow-700 dark:text-yellow-300',
    ];
    $iconPath = $type === 'warning'
        ? 'M12 9v4m0 4h.01M10.29 3.86l-8.18 14.14A2 2 0 003.82 21h16.36a2 2 0 001.71-3l-8.18-14.14a2 2 0 00-3.42 0z'
        : 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
@endphp

<div {{ $attributes->class(['flex items-start gap-3 rounded-xl border px-4 py-3 text-sm', $styles[$type] ?? $styles['info']]) }}>
    <svg class="mt-0.5 h-5 w-5 flex-none" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $iconPath }}"/>
    </svg>
    <div>{{ $slot }}</div>
</div>
