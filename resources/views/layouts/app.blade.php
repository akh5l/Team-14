<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="logo-text">Bridge 14 Games</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="preload" href="/images/background.webp" as="image">
    @vite('resources/css/app.css')
</head>

<div id="cursor-aura"></div>

<body class="flex flex-col h-full variable-text">

    <header class="bg-[#2c2f66] p-4 flex justify-between items-center">
        <a href="{{ url('/home') }}" class="flex items-center gap-2 text-white font-bold text-xl sm:text-2xl variable-heading">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 sm:h-15 w-auto">
            <p id="logo-text">Bridge 14 Games</p>
        </a>

        <nav class="space-x-4 text-white font-semibold flex bg-[#2c2f66] rounded-xl px-4 py-2">

            <div class="flex items-center space-x-2 bg-[#6163b3] rounded-xl px-3 py-2">
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

            <div class="flex items-center space-x-2 bg-[#6163b3] rounded-xl px-3 py-2 gap-x-4">
                <a href="#" class="hover:underline variable-heading">Sign up / Sign in</a>
                <a href="{{ url('/about') }}" class="hover:underline variable-heading">About Us</a>
                <a href="{{ url('/products') }}" class="hover:underline variable-heading">Shop</a>
                <a href="{{ url('/cart') }}" class="hover:underline variable-heading">Cart</a>
                <a href="{{ url('/faq') }}" class="hover:underline variable-heading">FAQ</a>
                <a href="{{ url('/contact') }}" class="hover:underline variable-heading">Contact</a>
            </div>

        </nav>
    </header>

    <button
        id="themeToggle"
        class="fixed bottom-5 right-5 text-2xl bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition select-none z-50"
    >
        🌙
    </button>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-[#13122a] text-gray-300 p-6 mt-auto">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0">
            &copy; {{ date('Y') }} Bridge 14 Games
        </div>
    </footer>



    <style>
        .star {
            position: absolute;
            border-radius: 50%;
            background: white;
            animation: drift 5s linear infinite, twinkle 3s ease-in-out infinite;
        }

        @keyframes drift {
            0%   { transform: translate(0, 0); }
            50%  { transform: translate(2px, -1px); }
            100% { transform: translate(0, 0); }
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50%      { opacity: 1; }
        }
    </style>

</body>
</html>
