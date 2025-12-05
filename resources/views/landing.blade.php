@extends('layouts.app')
@section('content')
    <section class="relative h-screen w-full overflow-hidden bg-black">
        <div id="star-layer" class="absolute inset-0 z-0"></div>
        {{-- <div id="mouse-trail"></div> --}}

        <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4">
            <h1 class="text-5xl font-bold">Welcome to Bridge 14 Games</h1>

            <h2 class="text-2xl font-bold"><br>Discover Your New Favourite Game</h2>

            <a href="/home"
                class="my-8 bg-gray-900 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg transition">Shop
                Now</a>
        </div>
    </section>
@endsection
