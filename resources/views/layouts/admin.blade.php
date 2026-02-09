<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link
    rel="icon"
    type="image/png"
    href="{{ asset('storage/' . $companyProfile->logo) }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    {{-- Alpine Store (GLOBAL – untuk sidebar & theme) --}}
    <script>
        document.addEventListener('alpine:init', () => {

            Alpine.store('theme', {
                theme: localStorage.getItem('theme') ?? 'light',
                init() { this.apply(); },
                toggle() {
                    this.theme = this.theme === 'light' ? 'dark' : 'light';
                    localStorage.setItem('theme', this.theme);
                    this.apply();
                },
                apply() {
                    document.documentElement.classList.toggle('dark', this.theme === 'dark');
                }
            });

            Alpine.store('sidebar', {
                isExpanded: window.innerWidth >= 1280,
                isMobileOpen: false,
                isHovered: false,

                toggleExpanded() {
                    this.isExpanded = !this.isExpanded;
                    this.isMobileOpen = false;
                },

                toggleMobileOpen() {
                    this.isMobileOpen = !this.isMobileOpen;
                },

                setMobileOpen(val) {
                    this.isMobileOpen = val;
                },

                setHovered(val) {
                    if (window.innerWidth >= 1280 && !this.isExpanded) {
                        this.isHovered = val;
                    }
                }
            });
        });
    </script>
</head>

<body
    class="h-full bg-app-bg text-app-text admin-scope"
    x-data
    x-init="
        const checkScreen = () => {
            if (window.innerWidth < 1280) {
                $store.sidebar.isExpanded = false;
                $store.sidebar.isMobileOpen = false;
            } else {
                $store.sidebar.isExpanded = true;
                $store.sidebar.isMobileOpen = false;
            }
        };
        checkScreen();
        window.addEventListener('resize', checkScreen);
    "
>

    {{-- SIDEBAR --}}
    @include('pages.admin.partials.sidebar')

    {{-- MOBILE OVERLAY --}}
    <div
        x-show="$store.sidebar.isMobileOpen"
        x-transition.opacity
        @click="$store.sidebar.isMobileOpen = false"
        class="fixed inset-0 z-40 bg-black/60 xl:hidden">
    </div>

    {{-- CONTENT WRAPPER --}}
    <div
        class="min-h-screen transition-all duration-300"
        :class="{
            'xl:ml-[290px]': $store.sidebar.isExpanded,
            'xl:ml-[90px]': !$store.sidebar.isExpanded
        }"
    >

        {{-- HEADER --}}
        @include('pages.admin.partials.header')

        {{-- PAGE CONTENT --}}
        <main class="p-6">
            @yield('content')
        </main>

    </div>

</body>
</html>
