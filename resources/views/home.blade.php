@extends('layouts.app')
@section('content')
    <section class="relative h-96 flex items-center justify-center text-center text-black overflow-hidden bg-black">
      <div id="star-layer"></div>

        <div class="backdrop-blur-xl text-white bg-black/50 rounded-full px-20 py-5">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">Discover Your New Favourite Game</h1>
            <p class="mb-6 text-lg md:text-xl drop-shadow-lg">The first stop shop for all your tabletop and video gaming
                needs</p>
            <div class="flex justify-center space-x-4">
                <a href="/products"
                    class="bg-gray-800 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition">All Products</a>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center mb-8">Featured Products</h2>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach ($featured as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach

        </div>
    </section>


    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-8">Categories</h2>
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-blue-500 text-white p-4 rounded-lg cursor-pointer hover:bg-blue-600 transition">Tabletop
                    Games</div>
                <div class="bg-green-500 text-white p-4 rounded-lg cursor-pointer hover:bg-green-600 transition">Video Games
                </div>
                <div class="bg-purple-500 text-white p-4 rounded-lg cursor-pointer hover:bg-purple-600 transition">Video
                    Gaming Accessories</div>
                <div class="bg-yellow-500 text-white p-4 rounded-lg cursor-pointer hover:bg-yellow-600 transition">Tabletop
                    Gaming Accessories</div>
                <div class="bg-red-500 text-white p-4 rounded-lg cursor-pointer hover:bg-yellow-600 transition">Consoles
                </div>

            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12 text-center">
        <h2 class="text-3xl font-bold mb-8">Why Choose Bridge 14 Games?</h2>
        <div class="flex flex-wrap justify-center gap-6">
            <div class="bg-gray-100 p-6 rounded-lg w-full md:w-1/3 shadow hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-2">Wide Selection</h3>
                <p>Explore our vast collection of tabletop and gaming paraphernalia.<br>From tabletop games to video games
                    and consoles, we're sure that we have something you'll love</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg w-full md:w-1/3 shadow hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-2">Expert Recommendations</h3>
                <p>Our team will help you find the perfect game for you based on your needs. Simply drop us a message via our 'Contact Us' page, or come speak to us in store</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg w-full md:w-1/3 shadow hover:shadow-xl transition">
                <h3 class="text-xl font-semibold mb-2">Fast Shipping</h3>
                <p>Quick and reliable dispatch on all orders with free shipping on orders over £40</p>
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
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  //ensures the inputted email follows the correct format (local@domain.)
                if (!emailRegex.test(email)) {  //basic check against the regex. this ensures that the form is both valid and not null
                alert('Enter a valid email address.'); 
                return;
                }
                console.log('email:', email);   //logs the email to the developer console (right click --> inspect --> console) to confirm the form works
            });
            </script>
        </div>
    </section>
@endsection
