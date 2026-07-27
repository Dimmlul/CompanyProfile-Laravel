{{-- Sidebar navigation link with active state. --}}
@props([
    'href',
    'active' => false,
    'icon' => null
])

<a
    href="{{ $href }}"
    class="flex items-center justify-between gap-3
           rounded-xl px-3 py-2 transition
           {{ $active
                ? 'bg-indigo-500/10 text-brand-accent'
                : 'text-app-muted hover:bg-app-surface-2 hover:text-app-heading'
           }}"
>
    <div class="flex items-center gap-3">
        @if ($icon)
            <span class="relative shrink-0">
                <x-common.icon :name="$icon" class="h-5 w-5" />

                {{-- Dot indicator: the only visible cue when the sidebar is collapsed to
                     icon-only width, since the text badge below is hidden in that state. --}}
                @if (isset($badge))
                    <span
                        x-show="!$store.sidebar.isExpanded"
                        x-cloak
                        class="absolute -right-1 -top-1 h-2.5 w-2.5 rounded-full bg-brand-main ring-2 ring-[var(--color-app-bg)]"
                    ></span>
                @endif
            </span>
        @endif

        <span
            class="whitespace-nowrap transition-opacity duration-200"
            :class="{
                'opacity-100': $store.sidebar.isExpanded,
                'opacity-0': !$store.sidebar.isExpanded
            }"
        >
            {{ $slot }}
        </span>
    </div>

    {{-- BADGE (expanded state: full count pill) --}}
    @if (isset($badge))
        <span
            x-show="$store.sidebar.isExpanded"
            class="ml-auto rounded-full
                   bg-indigo-500/20
                   px-2 py-0.5
                   text-xs font-medium
                   text-brand-accent"
        >
            {{ $badge }}
        </span>
    @endif
</a>
