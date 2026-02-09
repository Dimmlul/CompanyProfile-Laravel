@props([
    'href',
    'active' => false,
    'icon' => null,
])

<a
    href="{{ $href }}"
    class="group flex items-center gap-3 rounded-xl px-3 py-2.5
           transition-all duration-200
           {{ $active
                ? 'bg-white/5 text-app-text'
                : 'text-app-muted hover:text-app-text hover:bg-white/5'
           }}"
>

    {{-- ICON (ALWAYS VISIBLE, EVEN WHEN COLLAPSED) --}}
    @if ($icon)
        <x-admin.sidebar.icon
            :name="$icon"
            class="h-5 w-5 shrink-0"
        />
    @endif

    {{-- LABEL (HIDDEN WHEN COLLAPSED) --}}
    <span
        x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
        x-transition.opacity
        class="truncate font-medium"
    >
        {{ $slot }}
    </span>

</a>
