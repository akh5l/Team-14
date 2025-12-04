<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="logo-text">Bridge 14 Games</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/app.js')
</head>



<body class="flex flex-col h-full variable-text antialiased">
  
    <div id="cursor-aura"></div>

    <header class="bg-black/90 p-4 flex justify-between items-center">
        <a href="{{ url('/home') }}"
            class="flex items-center gap-2 text-white font-bold text-xl sm:text-2xl variable-heading mx-5">
            <img src="{{ asset('images/logo-no-text.webp') }}" alt="Logo" class="h-12 sm:h-15 w-auto">
            {{-- <p id="logo-text">Bridge 14 Games</p> --}}
        </a>

        <nav class="space-x-4 text-white font-semibold flex">

            <div class="flex items-center space-x-2 bg-white/20 rounded-xl px-3 py-2">
                <label for="weightSlider" class="text-white text-sm font-semibold exclude-var-text">
                    Font Weight
                </label>

                <input
                    type="range"
                    id="weightSlider"
                    min="500"
                    max="800"
                    value="500"
                    class="h-1 w-32 rounded-full accent-yellow-400 bg-white/40"
                >
            </div>

            <div class="flex items-center space-x-2 bg-white/20 rounded-xl px-3 py-2 gap-x-4">
                @auth
                    <a href="{{ url('/profile') }}" class="hover:underline variable-heading">Profile</a>

                    <form method="POST" action=" {{ route('logout') }}">
                        @csrf
                        <button class="hover:underline variable-heading">Logout</button>
                    </form>

                    <a href="{{ url('/cart') }}" class="hover:underline variable-heading">Cart</a>
                @endauth
                @guest
                    <a href="{{ url('/login') }}" class="hover:underline variable-heading">Sign in</a>
                    <a href="{{ url('/register') }}" class="hover:underline variable-heading">Register</a>
                @endguest

                <a href="{{ url('/products') }}" class="hover:underline variable-heading">Shop</a>
                <a href="{{ url('/faq') }}" class="hover:underline variable-heading">FAQ</a>
                <a href="{{ url('/contact-us') }}" class="hover:underline variable-heading">Contact</a>
                <a href="{{ url('/about') }}" class="hover:underline variable-heading">About Us</a>


            </div>

        </nav>
    </header>

    <button
        id="themeToggle"
        class="fixed bottom-5 right-5 text-2xl bg-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-gray-500 transition select-none z-50"
    >
        🌙
    </button>

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
