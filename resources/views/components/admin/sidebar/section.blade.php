@props(['title'])

<p
    x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
    x-transition.opacity
    class="mb-3 px-3 text-xs uppercase tracking-widest text-app-muted"
>
    {{ $title }}
</p>
