<!-- resources/views/pages/admin/partials/header.blade.php -->

<div
    class="sticky top-0 z-40 w-full
           admin-scope
           border-b border-[var(--color-border-soft)]
           transition-all duration-300"
>
    <div class="flex h-14 w-full items-center justify-between px-4 lg:px-6">

        {{-- LEFT --}}
        <div class="flex items-center gap-3">

            {{-- DESKTOP TOGGLE --}}
            <button
                class="hidden xl:flex h-10 w-10 items-center justify-center
                       rounded-lg border border-[var(--color-border-soft)] btn-admin"
                @click="$store.sidebar.toggleExpanded()"
            >
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 18 18">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- MOBILE TOGGLE --}}
            <button
                class="xl:hidden h-10 w-10 flex items-center justify-center
                       rounded-lg border border-[var(--color-border-soft)] btn-admin"
                @click="$store.sidebar.toggleMobileOpen()"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <h1 class="hidden sm:block text-sm font-semibold">
                @yield('title', 'Dashboard')
            </h1>
        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-3">

            <a
                href="{{ route('home') }}"
                target="_blank"
                class="hidden sm:flex items-center gap-2
                       h-10 px-3 rounded-lg
                       border border-[var(--color-border-soft)]
                       btn-admin"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10"/>
                </svg>
                <span>Home</span>
            </a>

            {{-- USER MENU COMPONENT --}}
            <x-admin.header.user-menu />
        </div>

    </div>
</div>
