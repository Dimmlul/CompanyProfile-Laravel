<header
    x-data="{ mobileOpen: false, userOpen: false }"
    class="sticky top-0 z-50 site-header border-b"
>
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-16 items-center justify-between">

            {{-- LEFT : LOGO + NAV --}}
            <div class="flex items-center gap-10">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    @if (!empty($companyProfile->logo))
                        <img src="{{ asset('storage/' . $companyProfile->logo) }}"
                             alt="{{ $companyProfile->company_name }}" class="h-8 w-auto object-contain">
                    @endif
                    <span class="truncate text-lg font-semibold text-app-heading">
                        {{ $companyProfile->company_name ?? 'Company' }}
                    </span>
                </a>

                <nav class="hidden items-center gap-8 text-sm md:flex">
                    @php
                        $base = 'relative text-app-muted transition hover:text-app-heading';
                        $after = 'after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0
                                  after:bg-brand-accent after:transition-all after:duration-300';
                        $active = 'text-app-heading after:w-full';
                        $links = [
                            'home' => ['Home', 'home'],
                            'about' => ['About', 'about'],
                            'articles' => ['Articles', 'articles*'],
                            'products' => ['Products', 'products*'],
                            'events' => ['Events', 'events*'],
                            'gallery' => ['Gallery', 'gallery*'],
                            'contact' => ['Contact', 'contact'],
                        ];
                    @endphp
                    @foreach ($links as $route => [$label, $pattern])
                        <a href="{{ route($route) }}"
                           class="{{ $base }} {{ $after }} {{ request()->routeIs($pattern) ? $active : 'hover:after:w-full' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </nav>
            </div>

            {{-- RIGHT --}}
            <div class="flex items-center gap-2">

                {{-- THEME TOGGLE --}}
                <button
                    x-data="{ dark: document.documentElement.classList.contains('dark') }"
                    @click="dark = !dark; document.documentElement.classList.toggle('dark', dark); localStorage.setItem('theme', dark ? 'dark' : 'light')"
                    class="rounded-lg border border-app-border p-2 text-app-muted transition hover:text-app-heading"
                    aria-label="Toggle theme"
                >
                    {{-- sun (shown in light) --}}
                    <svg x-show="!dark" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path stroke-linecap="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
                    </svg>
                    {{-- moon (shown in dark) --}}
                    <svg x-show="dark" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                    </svg>
                </button>

                {{-- MOBILE HAMBURGER --}}
                <button @click="mobileOpen = !mobileOpen"
                        class="rounded-lg border border-app-border p-2 text-app-muted transition hover:text-app-heading md:hidden">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                {{-- DESKTOP AUTH --}}
                <div class="hidden items-center gap-2 md:flex">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn-primary btn-sm">Dashboard</a>
                        @else
                            <a href="{{ route('cart.index') }}"
                               class="flex items-center gap-2 rounded-lg border border-app-border px-3 py-2 text-sm
                                      text-app-muted transition hover:text-app-heading">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.6 3M7 13h10l4-8H5.6M7 13L5.8 18a1 1 0 001 1h10a1 1 0 001-1l-1.2-5M9 21a1 1 0 100-2 1 1 0 000 2zm6 0a1 1 0 100-2 1 1 0 000 2z"/>
                                </svg>
                                <span class="hidden sm:inline">Cart</span>
                            </a>

                            <div class="relative" @click.outside="userOpen = false">
                                <button @click="userOpen = !userOpen"
                                        class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm text-app-text transition hover:text-app-heading">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0116 0"/>
                                    </svg>
                                    {{ auth()->user()->name }}
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>

                                <div x-show="userOpen" x-transition x-cloak
                                     class="surface absolute right-0 mt-3 w-52 overflow-hidden rounded-xl shadow-xl">
                                    <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-sm text-app-text hover:bg-app-surface-2 hover:text-app-heading">Orders</a>
                                    <a href="{{ route('user.messages.index') }}" class="block px-4 py-3 text-sm text-app-text hover:bg-app-surface-2 hover:text-app-heading">Messages</a>
                                    <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-sm text-app-text hover:bg-app-surface-2 hover:text-app-heading">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-3 text-left text-sm text-danger hover:bg-danger/10">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn-outline btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- MOBILE DROPDOWN --}}
    <div x-show="mobileOpen" x-transition x-cloak @click.outside="mobileOpen = false"
         class="absolute inset-x-0 top-16 border-t border-app-border bg-app-surface md:hidden">
        <nav class="flex flex-col divide-y divide-app-border px-6 py-4 text-sm">
            @foreach (['home' => 'Home', 'about' => 'About', 'articles' => 'Articles', 'products' => 'Products', 'events' => 'Events', 'gallery' => 'Gallery', 'contact' => 'Contact'] as $route => $label)
                <a href="{{ route($route) }}" class="py-3 text-app-text hover:text-app-heading">{{ $label }}</a>
            @endforeach

            @auth
                @if(!auth()->user()->isAdmin())
                    <a href="{{ route('cart.index') }}" class="py-3 text-app-text hover:text-app-heading">Cart</a>
                    <a href="{{ route('orders.index') }}" class="py-3 text-app-text hover:text-app-heading">Orders</a>
                    <a href="{{ route('user.messages.index') }}" class="py-3 text-app-text hover:text-app-heading">Messages</a>
                    <a href="{{ route('profile.index') }}" class="py-3 text-app-text hover:text-app-heading">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-3 text-left text-danger">Logout</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-outline btn-sm mt-4">Login</a>
            @endauth
        </nav>
    </div>
</header>
