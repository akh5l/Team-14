<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="logo-text">Bridge 14 Games</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @livewireStyles
</head>

<body class="flex flex-col h-full variable-text antialiased" id="star-layer">
    <div class="flex flex-col lg:flex-row items-center justify-between bg-black p-4">
        <a href="{{ url('/home') }}"
            class="flex items-center gap-2 text-white font-bold text-xl sm:text-2xl variable-heading">
            <img src="{{ asset('images/logo-dark.webp') }}" alt="Logo" class="h-auto max-h-12 sm:max-h-16 w-auto mx-8 mb-1">
            {{-- <p id="logo-text">Bridge 14 Games</p> --}}
        </a>
        <nav class="flex flex-col lg:flex-row gap-2 lg:gap-4 text-white font-semibold">
            <div class="flex items-center space-x-2 bg-white/20 rounded-xl px-3 py-2">
                <label for="weightSlider" class="text-white text-sm font-semibold exclude-var-text">
                    Font Weight
                </label>
                <input type="range" id="weightSlider" min="500" max="800" value="500"
                    class="h-1 w-32 rounded-full accent-yellow-400 bg-white/40">
            </div>
            <div class="flex items-center space-x-2 bg-white/20 rounded-xl px-3 py-2 gap-x-2">
                @auth
                    <a href="{{ route('profile.edit') }}" class="hover:underline variable-heading">Profile</a>
                    <a href="{{ url('/cart') }}" class="hover:underline variable-heading">Cart</a>
                @endauth
                @guest
                    <a href="{{ url('/login') }}" class="hover:underline variable-heading">Sign in</a>
                    <a href="{{ url('/register') }}" class="hover:underline variable-heading">Register</a>
                @endguest
                <a href="{{ url('/products') }}" class="hover:underline variable-heading">Shop</a>
                <a href="{{ url('/faq') }}" class="hover:underline variable-heading">FAQs</a>
                <a href="{{ url('/about') }}" class="hover:underline variable-heading">About Us</a>
                <a href="{{ url('/contact-us') }}" class="hover:underline variable-heading">Contact</a>

            </div>
        </nav>
    </div>

    <button id="themeToggle"
        class="fixed bottom-5 right-5 text-2xl bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition select-none z-50">
        🌙
    </button>
    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-black text-gray-300 p-6 mt-auto">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0">
            &copy; {{ date('Y') }} Bridge 14 Games
        </div>
    </footer>
    @livewireScripts
</body>

</html>
