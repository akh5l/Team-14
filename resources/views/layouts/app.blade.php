<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridge 14 Games</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col h-full">

    <header class="bg-blue-600 p-4 flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-white font-bold text-xl sm:text-2xl">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 sm:h-15 w-auto">
            Bridge 14 Games
        </a>
        <nav class="space-x-4 text-white font-semibold">
            <a href="{{ url('/products') }}" class="hover:underline">Shop</a>
            <a href="#" class="hover:underline">Cart</a>
            <a href="#" class="hover:underline">Sign up / Sign in</a>
        </nav>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300 p-6 mt-auto">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0">
            &copy; {{ date('Y') }} Bridge 14 Games
        </div>
    </footer>

</body>
</html>
