@php
    use App\Models\CompanyProfile;
    $companyProfile = CompanyProfile::first();
@endphp

<aside
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
           transition-[width] duration-300 ease-out
           xl:translate-x-0
           overflow-y-auto"   {{-- 🔥 SCROLL FIX --}}

    :class="{
        'xl:w-[280px]': $store.sidebar.isExpanded,
        'xl:w-[88px]': !$store.sidebar.isExpanded,
        'w-[280px] translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full': !$store.sidebar.isMobileOpen
    }"
>

    {{-- BRAND --}}
    <x-admin.sidebar.brand :company-profile="$companyProfile" />

    {{-- NAV --}}
    <nav class="mt-4 px-3 pb-6 text-sm space-y-6">

        {{-- ========== MENU ========= --}}
        <div class="space-y-0.5">

            <x-admin.sidebar.label>Menu</x-admin.sidebar.label>

            <x-admin.sidebar.item
                href="{{ route('admin.dashboard') }}"
                :active="request()->is('admin/dashboard*')"
                icon="dashboard"
            >
                Dashboard
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.company-profile.index') }}"
                :active="request()->is('admin/company-profile*')"
                icon="company"
            >
                Company Profile
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.orders.index') }}"
                :active="request()->is('admin/orders*')"
                icon="orders"
            >
                Orders
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.messages.index') }}"
                :active="request()->is('admin/messages*')"
                icon="inbox"
            >
                Inbox
            </x-admin.sidebar.item>
        </div>

        {{-- ========== CONTENT ========= --}}
        <div class="space-y-0.5">

            <x-admin.sidebar.label>Content</x-admin.sidebar.label>

            <x-admin.sidebar.item
                href="{{ route('admin.articles.index') }}"
                :active="request()->is('admin/articles*')"
                icon="article"
            >
                Articles
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.products.index') }}"
                :active="request()->is('admin/products*')"
                icon="product"
            >
                Products
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.events.index') }}"
                :active="request()->is('admin/events*')"
                icon="event"
            >
                Events
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.gallery.index') }}"
                :active="request()->is('admin/gallery*')"
                icon="gallery"
            >
                Gallery
            </x-admin.sidebar.item>

            <x-admin.sidebar.item
                href="{{ route('admin.clients.index') }}"
                :active="request()->is('admin/clients*')"
                icon="client"
            >
                Clients
            </x-admin.sidebar.item>

        </div>

    </nav>
</aside>
