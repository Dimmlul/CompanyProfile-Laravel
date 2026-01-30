<header
    class="sticky top-0 z-50
           bg-[rgba(2,6,23,0.65)]
           backdrop-blur-md
           border-b border-white/10"
>
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-16 items-center justify-between">

            {{-- LEFT : LOGO + NAV --}}
            <div class="flex items-center gap-10">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if (!empty($companyProfile->logo))
                        <img
                            src="{{ asset('storage/' . $companyProfile->logo) }}"
                            alt="{{ $companyProfile->company_name }}"
                            class="h-8 w-auto object-contain"
                        >
                    @endif

                    <span class="text-lg font-semibold text-white leading-none">
                        {{ $companyProfile->company_name ?? 'Company' }}
                    </span>
                </a>

                {{-- NAV --}}
                <nav class="hidden md:flex items-center gap-8 text-sm">
                    @php
                        $navBase = 'relative text-white/70 transition';
                        $navHover = 'hover:text-indigo-400';
                        $navAfter = 'after:absolute after:left-0 after:-bottom-1
                                     after:h-[2px] after:w-0
                                     after:bg-gradient-to-r
                                     after:from-purple-400 after:to-indigo-400
                                     after:transition-all after:duration-300';
                        $navActive = 'text-indigo-400 after:w-full';
                    @endphp

                    <a href="{{ route('home') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('home') ? $navActive : 'hover:after:w-full' }}">
                        Home
                    </a>

                    <a href="{{ route('about') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('about') ? $navActive : 'hover:after:w-full' }}">
                        About
                    </a>

                    <a href="{{ route('articles') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('articles*') ? $navActive : 'hover:after:w-full' }}">
                        Articles
                    </a>

                    <a href="{{ route('products') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('products*') ? $navActive : 'hover:after:w-full' }}">
                        Products
                    </a>

                    <a href="{{ route('events') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('events*') ? $navActive : 'hover:after:w-full' }}">
                        Events
                    </a>

                    <a href="{{ route('gallery') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('gallery*') ? $navActive : 'hover:after:w-full' }}">
                        Gallery
                    </a>

                    <a href="{{ route('contact') }}"
                       class="{{ $navBase }} {{ $navHover }} {{ $navAfter }} {{ request()->routeIs('contact') ? $navActive : 'hover:after:w-full' }}">
                        Contact
                    </a>
                </nav>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-3">

                @auth
                    {{-- ADMIN --}}
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                            Dashboard
                        </a>

                    {{-- USER --}}
                    @else
                       {{-- CART --}}
                <div class="relative z-40">
                    <a href="{{ route('cart.index') }}"
                    class="flex items-center gap-2 rounded-lg
                            border border-white/15 px-2.5 py-2
                            text-sm text-white/80
                            hover:text-indigo-400
                            hover:border-indigo-400/50
                            hover:bg-indigo-500/10 transition">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 3h2l.6 3M7 13h10l4-8H5.6M7 13L5.8 18a1 1 0 001 1h10a1 1 0 001-1l-1.2-5M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
                        </svg>
                        <span class="hidden sm:inline">Cart</span>
                    </a>
                </div>

                    {{-- PROFILE DROPDOWN --}}
            <div class="relative group">
                <button
                    type="button"
                    class="flex items-center gap-2 rounded-lg
                        px-3 py-2 text-sm font-medium
                        text-white/80 hover:text-indigo-400
                        hover:bg-indigo-500/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 21a8 8 0 0116 0"/>
                    </svg>
                    {{ auth()->user()->name }}
                </button>

                <div
                    class="absolute right-0 mt-3 w-56
                        rounded-2xl border border-white/10
                        bg-[#020617]
                        shadow-[0_20px_60px_-15px_rgba(0,0,0,0.8)]
                        opacity-0 translate-y-2 scale-95 invisible
                        transition-all duration-200 ease-out
                        group-hover:visible
                        group-hover:opacity-100
                        group-hover:translate-y-0
                        group-hover:scale-100">

                    <a href="{{ route('profile.index') }}"
                    class="block px-4 py-3 text-sm
                            text-white/80 hover:text-indigo-400
                            hover:bg-indigo-500/10 transition">
                        Profile
                    </a>

                    <a href="{{ route('orders.index') }}"
                    class="block px-4 py-3 text-sm
                            text-white/80 hover:text-indigo-400
                            hover:bg-indigo-500/10 transition">
                        Orders
                    </a>

                    <div class="border-t border-white/10"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="w-full text-left px-4 py-3 text-sm
                                text-red-400 hover:bg-red-500/10 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

                    @endif
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg border border-white/20
                              px-4 py-2 text-sm font-medium
                              text-white hover:bg-indigo-500/10
                              hover:border-indigo-400 transition">
                        Login
                    </a>
                @endauth

            </div>
        </div>
    </div>
</header>
