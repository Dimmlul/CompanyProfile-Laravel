{{-- Admin top bar: sidebar toggles, theme switch, and account menu. --}}
<div class="sticky top-0 z-40 w-full admin-scope border-b border-app-border">
    <div class="flex h-14 w-full items-center justify-between px-4 lg:px-6">

        {{-- Left: sidebar toggles --}}
        <div class="flex items-center gap-3">
            {{-- Desktop: collapse / expand sidebar --}}
            <button class="btn-icon hidden xl:flex" @click="$store.sidebar.toggleExpanded()" aria-label="Toggle sidebar">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Mobile: open sidebar --}}
            <button class="btn-icon xl:hidden" @click="$store.sidebar.toggleMobileOpen()" aria-label="Open menu">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        {{-- Right: view site, theme, account --}}
        <div class="flex items-center gap-3">
            {{-- Open the public site in a new tab --}}
            <a href="{{ route('home') }}" target="_blank" rel="noopener"
               class="hidden h-10 items-center gap-2 rounded-lg border border-app-border bg-app-surface-2
                      px-3 text-sm text-app-text transition hover:text-app-heading sm:flex">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10"/>
                </svg>
                <span>Home</span>
            </a>

            {{-- Light / dark theme toggle --}}
            <button @click="$store.theme.toggle()" class="btn-icon" aria-label="Toggle theme">
                <svg x-show="$store.theme.theme === 'light'" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="4"/>
                    <path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                </svg>
                <svg x-show="$store.theme.theme === 'dark'" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            {{-- Account menu (avatar + logout) --}}
            <x-admin.header.user-menu />
        </div>
    </div>
</div>
