@props([
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'align' => 'left',   // left | center
])

<div {{ $attributes->class([
    'max-w-2xl',
    'mx-auto text-center' => $align === 'center',
]) }}>
    @if ($eyebrow)
        <span class="eyebrow">{{ $eyebrow }}</span>
    @endif

    @if ($title)
        <h2 class="section-title">{{ $title }}</h2>
    @endif

    @if ($subtitle)
        <p @class(['section-subtitle', 'mx-auto max-w-xl' => $align === 'center'])>{{ $subtitle }}</p>
    @endif

    {{ $slot }}
</div>
