{{-- Minimal layout for the login/register pages: just the page shell, no nav or sidebar. --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sign up')</title>
    <link
    rel="icon"
    type="image/png"
    href="{{ asset('storage/' . $companyProfile->logo) }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="bg-app-bg text-app-text">
    @yield('content')
    <div class="h-24"></div>
</body>
</html>
