@props([
    'href',
    'label' => 'Back',
])

<a href="{{ $href }}"
   {{ $attributes->class('group inline-flex items-center gap-2 text-sm font-medium text-app-muted transition hover:text-app-heading') }}>
    <svg class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-0.5"
         fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 18l-6-6 6-6"/>
    </svg>
    {{ $label }}
</a>
