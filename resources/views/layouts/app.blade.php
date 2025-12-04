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

    <header class="bg-black/90 p-4 flex justify-between items-center">
        <a href="{{ url('/home') }}"
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
                <a href="{{ url('/faq') }}" class="hover:underline variable-heading">FAQ</a>
                <a href="{{ url('/contact-us') }}" class="hover:underline variable-heading">Contact</a>


            </div>
        </nav>


    </header>


    <!-- Made the button for Light and Dark mode, starts with Light mode as default. -->
    <button id="themeToggle"
        class="fixed bottom-5 right-5 text-2xl bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition select-none z-50">
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

        // Making the Light and Dark Mode button switch when clicked on.
        const toggle = document.getElementById("themeToggle");
        const root = document.documentElement;

        if (localStorage.getItem("theme") === "dark") {
            root.classList.add("dark");
            toggle.textContent = "☀️";
        }

        toggle.addEventListener("click", () => {
            const isDark = root.classList.toggle("dark");
            toggle.textContent = isDark ? "☀️" : "🌙";
            localStorage.setItem("theme", isDark ? "dark" : "light");
        });


        // star background layer
        document.addEventListener("DOMContentLoaded", () => {
            const starLayer = document.getElementById("star-layer");

            const numStars = 60;

            for (let i = 0; i < numStars; i++) {
                const star = document.createElement("div");
                star.classList.add("absolute", "bg-white", "rounded-full");
                const size = Math.random() * 2 + 1; // 1px to 3px
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.top = `${Math.random() * 100}%`;
                star.style.left = `${Math.random() * 100}%`;
                starLayer.appendChild(star);
            }

            // parallax
            document.addEventListener('mousemove', (e) => {
                const stars = document.querySelectorAll('#star-layer div');
                const {
                    innerWidth,
                    innerHeight
                } = window;
                const offsetX = (e.clientX / innerWidth - 0.5) * 20;
                const offsetY = (e.clientY / innerHeight - 0.5) * 20;

                stars.forEach((star, index) => {
                    const speed = (index % 3 + 1) * 0.2;
                    star.style.transform = `translate(${offsetX * speed}px, ${offsetY * speed}px)`;
                });
            });
        });
    </script>

    <style>
        .star {
            position: absolute;
            border-radius: 50%;
            background: white;
            animation: drift 5s linear infinite, twinkle 3s ease-in-out infinite;
        }

        @keyframes drift {
            0% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(2px, -1px);
            }

            100% {
                transform: translate(0, 0);
            }
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 1;
            }
        }
    </style>

</body>

</html>
