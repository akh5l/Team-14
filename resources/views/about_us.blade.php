@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="relative h-[38rem] flex items-center justify-center text-center overflow-hidden">

    <img src="/images/background.webp" class="absolute inset-0 w-full h-full object-cover" />
    <div class="absolute inset-0 bg-black/60 dark:bg-black/70"></div>

    <div class="relative z-10 backdrop-blur-xl 
        bg-white/70 text-black
        dark:bg-black/40 dark:text-white
        rounded-3xl px-16 py-10 shadow-2xl">

        <h1 class="text-5xl font-bold mb-4 drop-shadow-lg">About Us</h1>

        <p class="text-xl drop-shadow-lg">
            Unity before division. Courage before doubt. Connection before conquest.
        </p>

    </div>

</section>

{{-- STORY --}}
<section class="max-w-5xl mx-auto px-6 py-16">

    <h2 class="text-4xl font-bold text-center mb-10
        text-black
        dark:text-white
        uppercase tracking-wide">

        Our Story

    </h2>

    <div class="space-y-6 
        text-black
        dark:text-gray-300
        leading-relaxed text-lg
        bg-[#f4ecff] dark:bg-transparent
        p-8 rounded-2xl shadow">

        <p>
            Founded in 2025, Bridge 14 Games started as a small local shop in Birmingham dedicated to providing
            high-quality tabletop and video games to casual gamers and hobbyists alike. Over the years, we've grown into
            a vibrant hub for gamers of all ages, offering everything from board games, card games and wargames to video
            games of every genre.
        </p>

        <p>
            Our name is derived from the 'Bridge 4' team from Brandon Sanderson's epic fantasy series,
            <em>The Stormlight Archive</em>. Like Kaladin and his team, we aim to build strength through unity and
            unwavering camaraderie: just as they forge bonds through adversity, we strive to forge bonds through
            tabletop and video games; bridging connections all along the way.
        </p>

        <p>
            At Bridge 14 Games, our mission is to create a welcoming space where gamers can connect, learn, and grow
            together. Whether you're new to gaming or a seasoned veteran, our community is built on shared passion,
            resilience, and mutual support. We believe that games are more than just entertainment—they're a way to
            build friendships, develop skills, and create lasting memories.
        </p>

        <p class="text-2xl font-bold text-center pt-4">
            Together, we're stronger.
        </p>

    </div>

</section>

{{-- TESTIMONIALS --}}
<section class="
    bg-[#ede4ff]
    dark:bg-[#151530]
    py-16">

    <div class="max-w-6xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold mb-10
            text-black
            dark:text-white">

            What Our Community Says

        </h2>

        <div class="grid md:grid-cols-2 gap-8">

            @foreach ([['quote' => 'Bridge 14 Games is my second home. The community is welcoming, and the staff always go above and beyond!', 'name' => 'John Doe'], ['quote' => 'I couldn\'t recommend this place enough! It is the perfect place to find fellow enthusiasts.', 'name' => 'Jane Doe']] as $testimonial)

                <div class="
                    bg-white text-black
                    dark:bg-[#1f1f3f] dark:text-gray-300
                    p-8 rounded-xl shadow
                    hover:shadow-xl transition hover:-translate-y-1">

                    <p class="mb-4 italic">
                        "{{ $testimonial['quote'] }}"
                    </p>

                    <h4 class="font-semibold text-purple-600">
                        - {{ $testimonial['name'] }}
                    </h4>

                </div>

            @endforeach

        </div>

    </div>

</section>

{{-- NEWSLETTER --}}
<section class="
    bg-[#e9dcff] text-black
    dark:bg-[#0d0d22] dark:text-white
    py-16">

    <div class="max-w-4xl mx-auto px-6 text-center">

        <h2 class="text-3xl mb-4 font-bold">
            Join the Bridge 14 Community
        </h2>

        <p class="mb-6">
            Subscribe to our newsletter to receive updates on new releases and exclusive deals!
        </p>

        <form class="flex max-w-md mx-auto space-x-2">

            <input type="email"
                placeholder="Enter your email"
                class="
                bg-white border border-purple-200 text-black
                dark:bg-gray-800 dark:text-white
                w-full p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400" />

            <button
                class="bg-[#9d8cd9] hover:bg-[#887abc] dark:bg-[#6163b3] dark:hover:bg-[#535495] text-white px-6 py-3 rounded-lg font-semibold transition hover:scale-105">

                Subscribe

            </button>

        </form>

    </div>

</section>

@endsection