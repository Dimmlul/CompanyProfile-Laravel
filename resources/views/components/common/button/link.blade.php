{{-- Generic styled link button; content is passed in via the component slot. --}}

@props([
    'href',
])

<a
    href="{{ $href }}"
    class="inline-flex items-center gap-2
           rounded-lg border border-white/10
           bg-white/5 px-4 py-2
           text-sm text-app-text
           hover:bg-white/10 transition"
>
    {{ $slot }}
</a>
