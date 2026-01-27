<!-- resources/views/pages/admin/partials/header.blade.php -->

<div
    class="sticky top-0 z-40 flex w-full
           bg-app-bg text-white
           border-b border-gray-700
           transition-all duration-300"
>
    <div class="flex w-full items-center justify-between px-4 py-3 lg:px-6">

        {{-- LEFT --}}
        <div class="flex items-center gap-3">

            {{-- Desktop Sidebar Toggle --}}
            <button
                class="hidden xl:flex h-10 w-10 items-center justify-center
                       rounded-lg border border-gray-700
                       hover:bg-gray-800 transition"
                @click="$store.sidebar.toggleExpanded()"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Mobile Sidebar Toggle --}}
            <button
                class="flex xl:hidden h-10 w-10 items-center justify-center
                       rounded-lg border border-gray-700
                       hover:bg-gray-800 transition"
                @click="$store.sidebar.toggleMobileOpen()"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Page Title --}}
            <h1 class="hidden sm:block text-sm font-semibold">
                @yield('title', 'Dashboard')
            </h1>
        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-3">

            {{-- 🔗 GO TO WEBSITE (CLIENT) --}}
            <a
                href="{{ route('home') }}"
                target="_blank"
                class="hidden sm:flex items-center gap-2
                       h-10 px-3 rounded-lg
                       border border-gray-700
                       text-sm font-medium
                       hover:bg-gray-800 transition"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10"/>
                </svg>
                <span>Home</span>
            </a>

            {{-- USER DROPDOWN --}}
            <div
                x-data="{ open: false }"
                class="relative flex items-center gap-3 pl-3 border-l border-gray-700"
            >
                <button
                    @click="open = !open"
                    @click.outside="open = false"
                    class="flex items-center gap-2"
                >
                    <img
                        src="https://i.pinimg.com/736x/c4/34/d8/c434d8c366517ca20425bdc9ad8a32de.jpg"
                        class="h-9 w-9 rounded-full object-cover border border-gray-600"
                        alt="Avatar"
                    >

                    <span class="hidden sm:block text-sm font-medium">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>

                    <svg class="h-4 w-4 hidden sm:block"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-cloak
                    x-show="open"
                    x-transition
                    class="absolute right-0 top-12 w-44
                           rounded-lg bg-app-bg
                           border border-gray-700 shadow-lg py-1"
                >
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-gray-800"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
