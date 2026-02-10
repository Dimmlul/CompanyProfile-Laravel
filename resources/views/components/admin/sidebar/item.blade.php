@props([
    'href',
    'active' => false,
    'icon' => null
])

<a
    href="{{ $href }}"
    class="flex items-center gap-3 rounded-xl px-3 py-2
           transition
           {{ $active
                ? 'bg-indigo-500/10 text-indigo-400'
                : 'text-app-muted hover:bg-white/5 hover:text-white'
           }}"
>
    @if ($icon)
        <x-common.icon :name="$icon" class="h-5 w-5 shrink-0" />
    @endif

    <span
        class="whitespace-nowrap transition-opacity duration-200"
        :class="{ 'opacity-100': $store.sidebar.isExpanded, 'opacity-0': !$store.sidebar.isExpanded }"
    >
        {{ $slot }}
    </span>
</a>
