{{-- Main public-site layout: page shell with header, footer, theme toggle and floating support chat. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Theme: apply saved preference before paint (light is the default) --}}
    <script>
        try {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        } catch (e) {}
    </script>

    <title>@yield('title','Website')</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('storage/' . $companyProfile->logo) }}"
    >

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    {{-- Vite: CSS, JS and Alpine (bundled) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>[x-cloak]{display:none!important}</style>
</head>

<body class="min-h-screen bg-app-bg text-app-text overflow-x-hidden">

    @include('pages.client.partials.header')

    <main>
        @yield('content')
    </main>

    @include('pages.client.partials.footer')

    {{-- Floating support chat (available on every public page) --}}
    <x-support-chat />

    {{-- PAGE SCRIPTS --}}
    @stack('scripts')

</body>
</html>
