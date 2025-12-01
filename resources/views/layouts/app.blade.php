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

<body class="flex flex-col h-full variable-text">

    <header class="bg-blue-600 p-4 flex justify-between items-center">
        <a href="{{ url('/') }}"
            class="flex items-center gap-2 text-white font-bold text-xl sm:text-2xl variable-heading">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 sm:h-15 w-auto">
            <p id="logo-text">Bridge 14 Games</p>
        </a>
        <nav class="space-x-4 text-white font-semibold flex">
            <div class="flex items-center space-x-2 bg-white/20 rounded-xl px-3 py-2">
                <label for="weightSlider" class="text-white text-sm font-semibold exclude-var-text">Font Weight</label>
                <input type="range" id="weightSlider" min="500" max="800" value="500"
                    class="h-1 w-32 rounded-full accent-yellow-400 bg-white/40">
            </div>

            <div class="flex items-center space-x-2 bg-white/20 rounded-xl px-3 py-2 gap-x-4">
                <a href="#" class="hover:underline variable-heading">Sign up / Sign in</a>
                <a href="{{ url('/cart') }}" class="hover:underline variable-heading">Cart</a>
                <a href="{{ url('/products') }}" class="hover:underline variable-heading">Shop</a>
                <a href="{{ url('/contact-us') }}" class="hover:underline variable-heading">Contact Us</a>
            </div>
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


    <script>
        document.getElementById("weightSlider").addEventListener("input", e => {
            const w = e.target.value;
            localStorage.setItem("fontWeight", w);

            document.querySelector('.variable-text').style.fontVariationSettings = `"wght" ${w}`;
        });

        document.addEventListener("DOMContentLoaded", () => {
            const saved = localStorage.getItem("fontWeight");

            if (saved) {
                const slider = document.getElementById("weightSlider");
                if (slider) slider.value = saved;

                document.querySelector('.variable-text').style.fontVariationSettings = `"wght" ${saved}`;
            }
        });
    </script>


</body>

</html>
