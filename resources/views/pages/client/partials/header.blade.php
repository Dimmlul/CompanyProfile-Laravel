<header class="sticky top-0 z-50 bg-app-bg border-b border-gray-800">
    <div class="mx-auto max-w-7xl px-6">
        <div class="flex h-16 items-center justify-between">

            <!-- Left: Logo + Nav -->
            <div class="flex items-center gap-10">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="text-lg font-semibold text-white">
                        PT Nexora Studio Digital
                    </span>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-8 text-sm">
                    <a href="{{ route('home') }}"
                       class="text-app-muted hover:text-white transition">
                        Home
                    </a>

                    <a href="{{ route('about') }}"
                       class="text-app-muted hover:text-white transition">
                        About
                    </a>

                    <a href="{{ route('articles') }}"
                       class="text-app-muted hover:text-white transition">
                        Articles
                    </a>

                    <a href="{{ route('products') }}"
                       class="text-app-muted hover:text-white transition">
                        Products
                    </a>

                    <a href="{{ route('events') }}"
                       class="text-app-muted hover:text-white transition">
                        Events
                    </a>

                    <a href="{{ route('gallery') }}"
                       class="text-app-muted hover:text-white transition">
                        Gallery
                    </a>

                    <a href="{{ route('contact') }}"
                       class="text-app-muted hover:text-white transition">
                        Contact
                    </a>
                </nav>

            </div>

            <!-- Right: Login / Dashboard -->
            <div class="flex items-center gap-4">

                @auth
                    <a href="{{ route('admin.dashboard') }}"
                       class="rounded-lg bg-btn-primary px-4 py-2
                              text-sm font-medium text-btn-text
                              hover:bg-btn-primary-hover transition">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="rounded-lg border border-gray-700
                              px-4 py-2 text-sm font-medium
                              text-white hover:bg-gray-800 transition">
                        Login
                    </a>
                @endauth

            </div>

        </div>
    </div>
</header>
