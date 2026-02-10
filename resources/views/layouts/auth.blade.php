<!-- resources/views/layouts/auth.blade.php -->
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body class="bg-app-bg text-app-text">
    @yield('content')
    <div class="h-24"></div>
</body>
</html>
