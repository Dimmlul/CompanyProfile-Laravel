<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('pageTransition', () => ({
                show: false,
                init() {
                    requestAnimationFrame(() => this.show = true)
                }
            }))
        })
    </script>
</head>

<body class="bg-app-bg text-app-text min-h-screen flex flex-col">

    <script>
document.addEventListener('alpine:init', () => {
    Alpine.directive('reveal', (el, { expression }, { effect }) => {
        let options = expression ? JSON.parse(expression) : {}

        let observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    el.classList.add('opacity-100', 'translate-y-0')
                    observer.unobserve(el)
                }
            },
            {
                threshold: options.threshold || 0.15,
            }
        )

        observer.observe(el)
    })
})
</script>

    {{-- HEADER --}}
    @include('pages.client.partials.header')

    {{-- MAIN CONTENT --}}
    <main
        class="flex-1"
        x-data="pageTransition"
        x-show="show"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
    >
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('pages.client.partials.footer')

    @stack('scripts')
</body>
</html>
