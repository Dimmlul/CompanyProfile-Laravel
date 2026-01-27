<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Website')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-app-bg text-app-text">

    {{-- HEADER --}}
    @include('pages.client.partials.header')

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('pages.client.partials.footer')

</body>
</html>
