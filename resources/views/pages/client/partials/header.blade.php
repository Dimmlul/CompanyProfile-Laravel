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

                {{-- NAVIGATION --}}
                <nav class="hidden md:flex items-center gap-8 text-sm">

                    <a href="{{ route('home') }}"
                       class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                        Home
                    </a>

                    <a href="{{ route('about') }}"
                       class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}">
                        About
                    </a>

                    <a href="{{ route('articles') }}"
                       class="nav-link {{ request()->routeIs('articles*') ? 'nav-link-active' : '' }}">
                        Articles
                    </a>

                    <a href="{{ route('products') }}"
                       class="nav-link {{ request()->routeIs('products*') ? 'nav-link-active' : '' }}">
                        Products
                    </a>

                    <a href="{{ route('events') }}"
                       class="nav-link {{ request()->routeIs('events*') ? 'nav-link-active' : '' }}">
                        Events
                    </a>

                    <a href="{{ route('gallery') }}"
                       class="nav-link {{ request()->routeIs('gallery*') ? 'nav-link-active' : '' }}">
                        Gallery
                    </a>

                    <a href="{{ route('contact') }}"
                       class="nav-link {{ request()->routeIs('contact') ? 'nav-link-active' : '' }}">
                        Contact
                    </a>

                </nav>
            </div>

            {{-- RIGHT : AUTH --}}
            <div class="flex items-center gap-4">

                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="btn-primary">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg border border-white/20
                              px-4 py-2 text-sm font-medium
                              text-white hover:bg-white/10 transition">
                        Login
                    </a>
                @endauth

            </div>

        </div>
    </div>
</header>
