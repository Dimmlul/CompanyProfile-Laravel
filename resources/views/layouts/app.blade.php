<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Website')</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('storage/' . $companyProfile->logo) }}"
    >

    {{-- VITE (CSS + JS + ALPINE) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- x-cloak --}}
    <style>[x-cloak]{display:none!important}</style>
</head>

<body class="min-h-screen bg-app-bg text-app-text overflow-x-hidden">

    @include('pages.client.partials.header')

    <main>
        @yield('content')
    </main>

    @include('pages.client.partials.footer')


</body>
</html>
