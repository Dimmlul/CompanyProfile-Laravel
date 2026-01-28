<!-- resources/views/pages/admin/partials/header.blade.php -->
<!-- Admin top navigation bar -->

<div
    class="sticky top-0 z-40 w-full
           admin-scope
           border-b border-[var(--color-border-soft)]
           transition-all duration-300"
>
    <div class="flex h-14 w-full items-center justify-between px-4 lg:px-6">

        <!-- LEFT : Sidebar toggles + page title -->
        <div class="flex items-center gap-3">

            <!-- Desktop sidebar toggle -->
            <button
                class="hidden xl:flex h-10 w-10 items-center justify-center
                       rounded-lg
                       border border-[var(--color-border-soft)]
                       btn-admin"
                @click="$store.sidebar.toggleExpanded()"
            >
                <!-- icon unchanged -->
                <svg class="h-8 w-8" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 18 18">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Mobile sidebar toggle -->
            <button
                class="xl:hidden h-10 w-10 flex items-center justify-center
                       rounded-lg
                       border border-[var(--color-border-soft)]
                       btn-admin"
                @click="$store.sidebar.toggleMobileOpen()"
            >
                <!-- icon unchanged -->
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Page title -->
            <h1 class="hidden sm:block text-sm font-semibold">
                @yield('title', 'Dashboard')
            </h1>
        </div>

        <!-- RIGHT : Quick link + user menu -->
        <div class="flex items-center gap-3">

            <!-- Go to public website -->
            <a
                href="{{ route('home') }}"
                target="_blank"
                class="hidden sm:flex items-center gap-2
                       h-10 px-3 rounded-lg
                       border border-[var(--color-border-soft)]
                       btn-admin"
            >
                <!-- icon unchanged -->
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10"/>
                </svg>
                <span>Home</span>
            </a>

            <!-- User dropdown -->
            <div
                x-data="{ open: false }"
                class="relative flex items-center gap-3
                       pl-3 border-l border-[var(--color-border-soft)]"
            >
                <button
                    @click="open = !open"
                    @click.outside="open = false"
                    class="flex items-center gap-2"
                >
                    <img
                        src="https://i.pinimg.com/736x/c4/34/d8/c434d8c366517ca20425bdc9ad8a32de.jpg"
                        class="h-9 w-9 rounded-full object-cover
                               border border-[var(--color-border-soft)]"
                        alt="Avatar"
                    >

                    <span class="hidden sm:block text-sm font-medium">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>

                    <!-- icon unchanged -->
                    <svg class="hidden sm:block h-4 w-4"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div
                    x-cloak
                    x-show="open"
                    x-transition
                    class="absolute right-0 top-12 w-44
                           rounded-lg
                           admin-scope
                           border border-[var(--color-border-soft)]
                           shadow-lg py-1"
                >
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-left px-4 py-2
                                   text-sm text-red-400
                                   hover:bg-[rgba(255,255,255,0.08)]"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
