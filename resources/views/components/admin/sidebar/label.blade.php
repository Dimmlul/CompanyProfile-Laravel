{{-- resources/views/components/admin/sidebar/label.blade.php --}}

{{-- Small uppercase section label for grouping sidebar nav items; hidden when the sidebar is collapsed. --}}
<div
    x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
    x-transition.opacity
    class="px-3 text-[11px] uppercase tracking-widest text-app-muted select-none"
>
    {{ $slot }}
</div>
