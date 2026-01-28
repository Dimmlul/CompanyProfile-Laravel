<!-- resources/views/pages/admin/partials/sidebar.blade.php -->
<!-- Admin Sidebar Navigation -->

<aside
    x-data="{ openContent: false }"
    class="fixed top-0 left-0 z-50 h-screen
           admin-scope
           border-r border-[var(--color-border-soft)]
           transition-all duration-300
           xl:translate-x-0"
    :class="{
        /* DESKTOP WIDTH */
        'xl:w-[290px]': $store.sidebar.isExpanded,
        'xl:w-[90px]': !$store.sidebar.isExpanded,

        /* MOBILE BEHAVIOR */
        'w-[290px] translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full': !$store.sidebar.isMobileOpen
    }"
>

    <!-- ==========================================================
    | LOGO AREA
    ========================================================== -->
    <div
        class="flex h-16 items-center gap-3 px-6
               border-b border-[var(--color-border-soft)]"
    >
        <div class="flex h-9 w-9 items-center justify-center
                    rounded-lg overflow-hidden bg-white">
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXVc_Rr-sZWO7462pa4SOJT4jillPGMXFPpw&s"
                alt="Logo"
                class="h-full w-full object-cover"
            >
        </div>

        <span
            x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
            class="text-lg font-semibold tracking-wide"
        >
            Admin Panel
        </span>
    </div>

    <!-- ==========================================================
    | NAVIGATION
    ========================================================== -->
    <nav class="mt-6 px-4 text-sm">

        <!-- SECTION LABEL -->
        <p
            x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
            class="mb-3 px-3 text-xs uppercase tracking-widest
                   text-[var(--color-text-muted)]"
        >
            Menu
        </p>

        @php
            $itemBase = "group flex items-center gap-3 rounded-lg px-3 py-2.5 transition";
            $itemInactive = "text-[var(--color-text-muted)] hover:bg-[rgba(255,255,255,0.08)] hover:text-[var(--color-text-main)]";
            $itemActive = "bg-[var(--color-brand-soft)] text-[var(--color-text-main)]";
        @endphp

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="{{ $itemBase }} mb-1"
           :class="isActive('/admin/dashboard')
                ? '{{ $itemActive }}'
                : '{{ $itemInactive }}'">

            <!-- icon unchanged -->
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12h7V3H3v9zm11 9h7v-7h-7v7zM3 21h7v-7H3v7zm11-9h7V3h-7v9z"/>
            </svg>

            <span
                x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                class="font-medium"
            >
                Dashboard
            </span>
        </a>

        <!-- COMPANY PROFILE -->
        <a href="{{ route('admin.company-profile.index') }}"
           class="{{ $itemBase }} mb-4"
           :class="isActive('/admin/company-profile')
                ? '{{ $itemActive }}'
                : '{{ $itemInactive }}'">

            <!-- icon unchanged -->
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 21h18M9 8h1m4 0h1M4 21V4a1 1 0 011-1h14a1 1 0 011 1v17"/>
            </svg>

            <span
                x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                class="font-medium"
            >
                Company Profile
            </span>
        </a>

        <!-- SECTION LABEL -->
        <p
            x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
            class="mb-3 px-3 text-xs uppercase tracking-widest
                   text-[var(--color-text-muted)]"
        >
            Content
        </p>

        <!-- CONTENT TOGGLE -->
        <button
            type="button"
            @click="openContent = !openContent"
            class="{{ $itemBase }} w-full {{ $itemInactive }}"
        >
            <!-- icon unchanged -->
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0l-4 6H8l-4-6m16 0H4"/>
            </svg>

            <span
                x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                class="font-medium"
            >
                Content
            </span>

            <!-- arrow icon unchanged -->
            <svg
                x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                class="ml-auto h-4 w-4 transition-transform"
                :class="openContent ? 'rotate-180' : ''"
                fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- ======================================================
        | SUB MENU
        ====================================================== -->
        <div
            x-cloak
            x-show="openContent && ($store.sidebar.isExpanded || $store.sidebar.isMobileOpen)"
            x-transition
            class="mt-2 ml-6 pl-4
                   border-l border-[var(--color-border-soft)]
                   space-y-1"
        >

            <!-- ARTICLES -->
            <a href="{{ route('admin.articles.index') }}"
               class="{{ $itemBase }} text-sm"
               :class="isActive('/admin/articles')
                    ? '{{ $itemActive }}'
                    : '{{ $itemInactive }}'">

                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 11H5m14-4H5m14 8H5"/>
                </svg>

                <span>Articles</span>
            </a>

            <!-- PRODUCTS -->
            <a href="{{ route('admin.products.index') }}"
               class="{{ $itemBase }} text-sm"
               :class="isActive('/admin/products')
                    ? '{{ $itemActive }}'
                    : '{{ $itemInactive }}'">

                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M20 7H4m16 0l-2 13H6L4 7m6-3h4"/>
                </svg>

                <span>Products</span>
            </a>

            <!-- EVENTS -->
            <a href="{{ route('admin.events.index') }}"
               class="{{ $itemBase }} text-sm"
               :class="isActive('/admin/events')
                    ? '{{ $itemActive }}'
                    : '{{ $itemInactive }}'">

                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10m-13 9h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z"/>
                </svg>

                <span>Events</span>
            </a>

            <!-- GALLERY -->
            <a href="{{ route('admin.gallery.index') }}"
               class="{{ $itemBase }} text-sm"
               :class="isActive('/admin/gallery')
                    ? '{{ $itemActive }}'
                    : '{{ $itemInactive }}'">

                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 16l4-4a3 3 0 014 0l4 4m-6-6l1-1a3 3 0 014 0l3 3M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>

                <span>Gallery</span>
            </a>

            <!-- CLIENTS -->
            <a href="{{ route('admin.clients.index') }}"
               class="{{ $itemBase }} text-sm"
               :class="isActive('/admin/clients')
                    ? '{{ $itemActive }}'
                    : '{{ $itemInactive }}'">

                <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6H2v-2a4 4 0 014-4h1m6-4a4 4 0 11-8 0 4 4 0 018 0zm6 4a4 4 0 10-8 0"/>
                </svg>

                <span>Clients</span>
            </a>

        </div>

    </nav>
</aside>
