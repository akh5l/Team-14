@extends('layouts.app')
@section('content')
    <section class="relative h-screen w-full overflow-hidden bg-black">
        <div id="star-layer" class="absolute inset-0 z-0"></div>

        <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
            <h1 class="text-5xl font-bold">Welcome to Bridge 14 Games</h1>

            <h2 class="text-2xl font-bold"><br>Discover Your New Favourite Game</h2>

            <a href="/home"
                class="my-8 bg-gray-900 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg transition">Shop
                Now</a>
        </div>


    </section>


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


    <script>
        const starLayer = document.getElementById('star-layer');
        const starCount = 150;

        for (let i = 0; i < starCount; i++) {
            const star = document.createElement('div');
            const size = Math.random() * 2 + 1;

            star.className = 'star';
            star.style.width = `${size}px`;
            star.style.height = `${size}px`;
            star.style.top = `${Math.random() * 100}%`;
            star.style.left = `${Math.random() * 100}%`;

            star.style.opacity = Math.random() * 0.8 + 0.2;
            star.style.animationDuration = `${Math.random() * 15 + 2}s, ${Math.random() * 3 + 1}s`;
            starLayer.appendChild(star);
        }

        document.addEventListener('mousemove', (e) => {
            const stars = document.querySelectorAll('#star-layer div');
            const {
                innerWidth,
                innerHeight
            } = window;
            const offsetX = (e.clientX / innerWidth - 0.5) * 20; // adjust intensity
            const offsetY = (e.clientY / innerHeight - 0.5) * 20;

            stars.forEach((star, index) => {
                const speed = (index % 3 + 1) * 0.2; // different speed per layer
                star.style.transform = `translate(${offsetX * speed}px, ${offsetY * speed}px)`;
            });
        });
    </script>
@endsection
