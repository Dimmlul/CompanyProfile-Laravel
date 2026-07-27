{{-- Small uppercase section label for grouping sidebar nav items; hidden when the sidebar is collapsed. --}}
<div
    x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
    class="px-3 text-[11px] uppercase tracking-widest text-app-muted select-none"
>
    {{ $slot }}
</div>
