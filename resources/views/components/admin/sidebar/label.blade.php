{{-- resources/views/components/admin/sidebar/label.blade.php --}}

<div
    x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
    x-transition.opacity
    class="px-3 text-[11px] uppercase tracking-widest text-app-muted select-none"
>
    {{ $slot }}
</div>
