{{-- resources/views/pages/admin/partials/sidebar.blade.php --}}
{{-- Admin Sidebar Navigation --}}

@php
    use App\Models\CompanyProfile;
    use Illuminate\Support\Str;

    $companyProfile = CompanyProfile::first();
@endphp

<aside
    x-data="{
        openContent: false,
        init() {
            this.$watch('$store.sidebar.isExpanded', value => {
                if (value) {
                    this.openContent = true
                } else {
                    this.openContent = false
                }
            })
        }
    }"
    @mouseenter="
        if (window.innerWidth >= 1280 && !$store.sidebar.isPinned) {
            $store.sidebar.isExpanded = true
        }
    "
    @mouseleave="
        if (window.innerWidth >= 1280 && !$store.sidebar.isPinned) {
            $store.sidebar.isExpanded = false
        }
    "
    class="fixed top-0 left-0 z-50 h-screen
           admin-scope
           border-r border-[var(--color-border-soft)]
           bg-[var(--color-bg-sidebar)]
           transition-[width] duration-300 ease-out
           xl:translate-x-0"
    :class="{
        'xl:w-[290px]': $store.sidebar.isExpanded,
        'xl:w-[90px]': !$store.sidebar.isExpanded,

        'w-[290px] translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full': !$store.sidebar.isMobileOpen
    }"
>

    <!-- ==========================================================
    | LOGO AREA
    ========================================================== -->
    <div
        class="flex h-16 items-center gap-3 px-6
               border-b border-[var(--color-border-soft)]
               transition-all duration-300"
    >
        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white overflow-hidden shrink-0">
            @if ($companyProfile?->logo)
                <img src="{{ asset('storage/'.$companyProfile->logo) }}"
                     class="h-full w-full object-contain">
            @else
                <span class="text-sm font-bold text-indigo-600">
                    {{ Str::upper(Str::substr($companyProfile->company_name ?? 'CP', 0, 2)) }}
                </span>
            @endif
        </div>

        <span
            x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
            x-transition.opacity.duration.200ms
            class="text-lg font-semibold tracking-wide truncate"
        >
            {{ $companyProfile->company_name ?? 'Admin Panel' }}
        </span>
    </div>

    <!-- ==========================================================
    | NAVIGATION
    ========================================================== -->
    <nav class="mt-6 px-4 text-sm">

        <p
            x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
            x-transition.opacity
            class="mb-3 px-3 text-xs uppercase tracking-widest text-[var(--color-text-muted)]"
        >
            Menu
        </p>

        @php
            $itemBase = "group flex items-center gap-3 rounded-xl px-3 py-2.5 transition-all duration-200";
            $itemInactive = "text-[var(--color-text-muted)]
                             hover:bg-[rgba(255,255,255,0.06)]
                             hover:text-[var(--color-text-main)]";
            $itemActive = "bg-[var(--color-brand-soft)]
                           text-[var(--color-text-main)]
                           shadow-[inset_0_0_0_1px_rgba(255,255,255,0.04)]";
        @endphp

        <!-- DASHBOARD -->
        <a href="{{ route('admin.dashboard') }}"
           class="{{ $itemBase }} mb-1"
           :class="isActive('/admin/dashboard') ? '{{ $itemActive }}' : '{{ $itemInactive }}'">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12h7V3H3v9zm11 9h7v-7h-7v7zM3 21h7v-7H3v7zm11-9h7V3h-7v9z"/>
            </svg>

            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                  x-transition.opacity
                  class="font-medium">
                Dashboard
            </span>
        </a>

        <!-- COMPANY PROFILE -->
        <a href="{{ route('admin.company-profile.index') }}"
           class="{{ $itemBase }} mb-4"
           :class="isActive('/admin/company-profile') ? '{{ $itemActive }}' : '{{ $itemInactive }}'">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 21h18M9 8h1m4 0h1M4 21V4a1 1 0 011-1h14a1 1 0 011 1v17"/>
            </svg>

            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                  x-transition.opacity
                  class="font-medium">
                Company Profile
            </span>
        </a>

        <!-- ORDERS -->
        <a href="{{ route('admin.orders.index') }}"
           class="{{ $itemBase }} mb-4"
           :class="isActive('/admin/orders') ? '{{ $itemActive }}' : '{{ $itemInactive }}'">
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 8h14l-1.5 12.5a2 2 0 01-2 1.5H8.5a2 2 0 01-2-1.5L5 8z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 8V6a3 3 0 016 0v2"/>
            </svg>

            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                  x-transition.opacity
                  class="font-medium">
                Orders
            </span>
        </a>

        <!-- CONTENT -->
        <p
            x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
            x-transition.opacity
            class="mb-3 px-3 text-xs uppercase tracking-widest text-[var(--color-text-muted)]"
        >
            Content
        </p>

        <!-- CONTENT TOGGLE -->
        <button
            type="button"
            @click="openContent = !openContent"
            class="{{ $itemBase }} w-full {{ $itemInactive }}"
        >
            <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0l-4 6H8l-4-6m16 0H4"/>
            </svg>

            <span x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                  x-transition.opacity
                  class="font-medium">
                Content
            </span>

            <svg x-show="$store.sidebar.isExpanded || $store.sidebar.isMobileOpen"
                 class="ml-auto h-4 w-4 transition-transform duration-200"
                 :class="openContent ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- SUB MENU -->
        <div
            x-cloak
            x-show="openContent && ($store.sidebar.isExpanded || $store.sidebar.isMobileOpen)"
            x-transition.opacity.duration.200ms
            class="mt-2 ml-6 pl-4 border-l border-[var(--color-border-soft)] space-y-1"
        >
            <a href="{{ route('admin.articles.index') }}" class="{{ $itemBase }} text-sm {{ $itemInactive }}">Articles</a>
            <a href="{{ route('admin.products.index') }}" class="{{ $itemBase }} text-sm {{ $itemInactive }}">Products</a>
            <a href="{{ route('admin.events.index') }}" class="{{ $itemBase }} text-sm {{ $itemInactive }}">Events</a>
            <a href="{{ route('admin.gallery.index') }}" class="{{ $itemBase }} text-sm {{ $itemInactive }}">Gallery</a>
            <a href="{{ route('admin.clients.index') }}" class="{{ $itemBase }} text-sm {{ $itemInactive }}">Clients</a>
        </div>

    </nav>
</aside>
