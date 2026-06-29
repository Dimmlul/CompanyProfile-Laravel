<header
    x-data="{ mobileOpen: false, userOpen: false }"
    class="sticky top-0 z-50
           bg-[rgba(2,6,23,0.65)]
           backdrop-blur-md
           border-b border-white/10"
>
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-16 items-center justify-between">

            {{-- LEFT : LOGO --}}
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if (!empty($companyProfile->logo))
                        <img
                            src="{{ asset('storage/' . $companyProfile->logo) }}"
                            alt="{{ $companyProfile->company_name }}"
                            class="h-8 w-auto object-contain"
                        >
                    @endif
                    <span class="text-lg font-semibold text-white truncate">
                        {{ $companyProfile->company_name ?? 'Company' }}
                    </span>
                </a>

                {{-- DESKTOP NAV --}}
                <nav class="hidden md:flex items-center gap-8 text-sm">
                    @php
                        $base = 'relative text-white/70 transition';
                        $hover = 'hover:text-indigo-400';
                        $after = 'after:absolute after:left-0 after:-bottom-1 after:h-[2px]
                                  after:w-0 after:bg-gradient-to-r
                                  after:from-purple-400 after:to-indigo-400
                                  after:transition-all after:duration-300';
                        $active = 'text-indigo-400 after:w-full';
                    @endphp

                    <a href="{{ route('home') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('home') ? $active : 'hover:after:w-full' }}">Home</a>
                    <a href="{{ route('about') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('about') ? $active : 'hover:after:w-full' }}">About</a>
                    <a href="{{ route('articles') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('articles*') ? $active : 'hover:after:w-full' }}">Articles</a>
                    <a href="{{ route('products') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('products*') ? $active : 'hover:after:w-full' }}">Products</a>
                    <a href="{{ route('events') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('events*') ? $active : 'hover:after:w-full' }}">Events</a>
                    <a href="{{ route('gallery') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('gallery*') ? $active : 'hover:after:w-full' }}">Gallery</a>
                    <a href="{{ route('contact') }}" class="{{ $base }} {{ $hover }} {{ $after }} {{ request()->routeIs('contact') ? $active : 'hover:after:w-full' }}">Contact</a>
                </nav>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                {{-- MOBILE HAMBURGER --}}
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="md:hidden rounded-lg border border-white/15 p-2
                           text-white/80 hover:text-indigo-400
                           hover:border-indigo-400/50 hover:bg-indigo-500/10 transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2"
                         class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- DESKTOP AUTH --}}
                <div class="hidden md:flex items-center gap-2">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                                Dashboard
                            </a>
                        @else
                            {{-- CART ICON --}}
                            <a href="{{ route('cart.index') }}"
                               class="flex items-center gap-2 rounded-lg
                                      border border-white/15 px-3 py-2
                                      text-sm text-white/80
                                      hover:text-indigo-400
                                      hover:border-indigo-400/50
                                      hover:bg-indigo-500/10 transition">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="1.8"
                                     class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3h2l.6 3M7 13h10l4-8H5.6M7 13L5.8 18a1 1 0 001 1h10a1 1 0 001-1l-1.2-5M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
                                </svg>
                                <span class="hidden sm:inline">Cart</span>
                            </a>

                            {{-- USER DROPDOWN --}}
                            <div class="relative" @click.outside="userOpen = false">
                                <button
                                    @click="userOpen = !userOpen"
                                    class="flex items-center gap-2 rounded-lg
                                           px-3 py-2 text-sm text-white/80
                                           hover:text-indigo-400
                                           hover:bg-indigo-500/10 transition"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="1.8"
                                         class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M4 21a8 8 0 0116 0"/>
                                    </svg>
                                    {{ auth()->user()->name }}
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 24 24" fill="none"
                                         stroke="currentColor" stroke-width="2"
                                         class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div
                                    x-show="userOpen"
                                    x-transition
                                    class="absolute right-0 mt-3 w-52
                                           rounded-xl border border-white/10
                                           bg-bg-admin
                                           shadow-[0_20px_60px_-15px_rgba(0,0,0,0.8)]
                                           overflow-hidden"
                                >
                                    <a href="{{ route('orders.index') }}"
                                       class="block px-4 py-3 text-sm
                                              text-white/80 hover:text-indigo-400
                                              hover:bg-indigo-500/10">
                                        Orders
                                    </a>

                                    <a href="{{ route('user.messages.index') }}"
                                       class="block px-4 py-3 text-sm
                                              text-white/80 hover:text-indigo-400
                                              hover:bg-indigo-500/10">
                                        Messages
                                    </a>

                                    <a href="{{ route('profile.index') }}"
                                       class="block px-4 py-3 text-sm
                                              text-white/80 hover:text-indigo-400
                                              hover:bg-indigo-500/10">
                                        Profile
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full text-left px-4 py-3
                                                       text-sm text-red-400
                                                       hover:bg-red-500/10">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-lg border border-white/20
                                  px-4 py-2 text-sm text-white
                                  hover:bg-indigo-500/10 hover:border-indigo-400 transition">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- MOBILE DROPDOWN --}}
    <div
        x-show="mobileOpen"
        x-transition
        @click.outside="mobileOpen = false"
        class="md:hidden absolute inset-x-0 top-16
               bg-bg-admin border-t border-white/10"
    >
        <nav class="flex flex-col px-6 py-4 text-sm divide-y divide-white/10">

            <a href="{{ route('home') }}" class="py-3 text-white/80 hover:text-indigo-400">Home</a>
            <a href="{{ route('about') }}" class="py-3 text-white/80 hover:text-indigo-400">About</a>
            <a href="{{ route('articles') }}" class="py-3 text-white/80 hover:text-indigo-400">Articles</a>
            <a href="{{ route('products') }}" class="py-3 text-white/80 hover:text-indigo-400">Products</a>
            <a href="{{ route('events') }}" class="py-3 text-white/80 hover:text-indigo-400">Events</a>
            <a href="{{ route('gallery') }}" class="py-3 text-white/80 hover:text-indigo-400">Gallery</a>
            <a href="{{ route('contact') }}" class="py-3 text-white/80 hover:text-indigo-400">Contact</a>

            @auth
                @if(!auth()->user()->isAdmin())
                    <a href="{{ route('cart.index') }}" class="py-3 text-white/80 hover:text-indigo-400">Cart</a>
                    <a href="{{ route('orders.index') }}" class="py-3 text-white/80 hover:text-indigo-400">Orders</a>
                    <a href="{{ route('user.messages.index') }}" class="py-3 text-white/80 hover:text-indigo-400">Messages</a>
                    <a href="{{ route('profile.index') }}" class="py-3 text-white/80 hover:text-indigo-400">Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="py-3 text-left text-red-400 w-full">
                            Logout
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}"
                   class="mt-4 rounded-lg border border-white/20
                          px-4 py-2 text-center text-white">
                    Login
                </a>
            @endauth
        </nav>
    </div>
</header>
