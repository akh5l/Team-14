@extends('layouts.app')
@section('content')
    <section class="relative h-[38rem] flex items-center justify-center text-center text-white overflow-hidden">
        <img src="/images/background.webp" class="absolute inset-0 w-full h-full object-cover -z-10" />
        <div class="backdrop-blur-xl bg-black/50 rounded-full px-20 py-5">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">About Us</h1>
            <p class="mb-6 text-lg md:text-xl drop-shadow-lg">Unity before division. Courage before doubt. Connection before
                conquest.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12 bg-gradient-to-r from-gray-50 via-gray-100 to-gray-50 rounded-lg shadow-lg my-6">
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800 uppercase tracking-wide">Our Story</h2>
        <div class="prose mx-auto text-center text-gray-700 max-w-3xl">
            <p class="mb-4">
                Founded in 2025, Bridge 14 Games started as a small local shop in Birmingham dedicated to providing
                high-quality tabletop and video games to casual gamers and hobbyists alike. Over the years, we've grown into
                a vibrant hub for gamers of all ages, offering everything from board games, card games and wargames to video
                games of every genre.
            </p>
            <p class="mb-4">
                Our name is derived from the 'Bridge 4' team from Brandon Sanderson's epic fantasy series, <em>The
                    Stormlight Archive</em>. Like Kaladin and his team, we aim to build strength through unity and
                unwavering camaraderie: just as they forge bonds through adversity, we strive to forge bonds through
                tabletop and video games; bridging connections all along the way.
            </p>
            <p class="mb-4">
                At Bridge 14 Games, our mission is to create a welcoming space where gamers can connect, learn, and grow
                together. Whether you're new to gaming or a seasoned veteran, our community is built on shared passion,
                resilience, and mutual support. We believe that games are more than just entertainment—they're a way to
                build friendships, develop skills, and create lasting memories.
            </p>
            <p class="mb-8">
                Join us as we continue to grow and bridge communities through the power of play.
            </p>
            <p class="text-center text-2xl md:text-3xl font-bold text-gray-800 mt-8 drop-shadow-lg">Together, we're
                stronger.</p>
        </div>
    </section>

    <section class="py-12 bg-white-100">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8 text-gray-800">What Our Community Says</h2>
            <div class="grid md:grid-cols-2 gap-8">
                @foreach ([['quote' => 'Bridge 14 Games is my second home. The community is welcoming, and the staff always go above and beyond!', 'name' => 'John Doe'], ['quote' => 'I couldn\'t recommend this place enough! It is the perfect place to find fellow enthusiasts.', 'name' => 'Jane Doe']] as $testimonial)
                    <div
                        class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 duration-300">
                        <p class="mb-4 italic">"{{ $testimonial['quote'] }}"</p>
                        <h4 class="font-semibold text-purple-600">-{{ $testimonial['name'] }}</h4>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl mb-4">Join the Bridge 14 Community</h2>
            <p class="mb-6">Subscribe to our newsletter to receive updates on new releases and exclusive deals!</p>
            <form class="flex max-w-md mx-auto space-x-2">
                <input type="email" placeholder="Enter your email"
                    class="bg-gray-800 w-full p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                <button
                    class="bg-blue-500 hover:bg-blue-600 px-4 py-3 rounded-lg font-semibold transition">Subscribe</button>
            </form>
            <script>
                document.querySelector('form').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = this.querySelector('input[type="email"]');
                    let email = emailInput.value.trim(); //removes any whitespace from the inputted email
                    const emailRegex =
                    /^[^\s@]+@[^\s@]+\.[^\s@]+$/; //ensures the inputted email follows the correct format (local@domain.)
                    if (!emailRegex.test(
                        email)) { //basic check against the regex. this ensures that the form is both valid and not null
                        alert('Enter a valid email address.');
                        return;
                    }
                    console.log('email:',
                    email); //logs the email to the developer console (right click --> inspect --> console) to confirm the form works
                });
            </script>
        </div>
    </section>
@endsection
