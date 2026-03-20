@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-8">

        <div class="md:w-1/2">
            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow" />
        </div>

        <div class="md:w-1/2 flex flex-col justify-center">
            <h1 class="text-4xl font-bold mb-4 text-black dark:text-white">{{ $product->product_name }}</h1>
            <p class="text-lg mb-4 text-gray-800 dark:text-gray-200">{{ $product->description }}</p>

            <p class="text-2xl font-semibold mb-6 text-red-500">
                £{{ number_format($product->price, 2) }}
            </p>

            <div class="flex space-x-4">
                @auth
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button type="submit" class="bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition font-semibold">
                        Add to Cart
                    </button>
                </form>

                <form method="POST" action="{{ route('cart.buyNow', $product) }}">
                    @csrf
                    <button type="submit" class="bg-[#9d8cd9] hover:bg-[#8677bc] dark:bg-[#6163b3] dark:hover:bg-[#515399] text-white py-3 px-6 rounded-lg transition font-semibold">
                        Buy Now
                    </button>
                </form>
                @endauth

                @guest
                <a href="/login" class="bg-[#9d8cd9] hover:bg-[#8879bf] dark:bg-[#6163b3] dark:hover:bg-[#505193] text-white py-3 px-6 rounded-lg transition font-semibold">
                    Sign in to buy
                </a>
                @endguest

            </div>
        </div>

    </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl text-black dark:text-white font-bold mb-8 text-center">Product Details & Reviews</h2>

    <div class="grid md:grid-cols-2 gap-8">

        <div>
            <h3 class="text-2xl text-black dark:text-white font-semibold mb-4">Product Details</h3>
            {{-- showing description again is redundant here --}}

            {{-- <p class="mb-4">
                    {{ $product->description }}
            </p> --}}

            <ul class="list-disc list-inside mb-4 text-gray-800 dark:text-gray-300">

                @if ($product->category_id == 1)
                <li>Includes all items and instructions necessary to begin your journey</li>
                <li>Suitable for ages 13 and up</li>
                @elseif ($product->category_id == 2)
                {{-- game specific details --}}
                @foreach (['platform', 'developer', 'age_rating'] as $field)
                @if (!empty($product->$field))
                <li><strong>{{ ucfirst(str_replace('_', ' ', $field)) }}:</strong> {{ $product->$field }}
                </li>
                @endif
                @endforeach
                <br>
                <li>Features engaging and immersive gameplay</li>
                @elseif ($product->category_id == 3)
                <li>Perfect for enhancing your gameplay experience </li>
                <li>For hobbyists and casual gamers alike</li>
                @elseif ($product->category_id == 4)
                <li>1-year warranty included</li>
                <li>Built from durable materials</li>
                @elseif ($product->category_id == 5)
                <li>Includes all necessary cables and controllers</li>
                <li>Games sold separately</li>
                @endif

            </ul>
        </div>

        <div>
            <h3 class="text-2xl font-semibold mb-4 dark:text-white">Customer Reviews</h3>

            @auth
            <form method="POST" action="{{ route('reviews.store', $product->product_id) }}">
                @csrf

                <textarea name="comment" class="w-full bg-[#e5e0f7] dark:bg-[#292755] border border-[#6163b3] text-white palceholder-gray-800 dark:placeholder-gray-200 rounded-lg px-4 py-2 mb-3" placeholder="Write your review..." required></textarea>

                <div class="flex flex-col sm:flex-row gap-3 mb-8">
                    <select name="rating" class="w-1/2 bg-[#e5e0f7] dark:bg-[#292755] border dark:border-[#6163b3] dark:text-white rounded-lg px-4 py-2" required>
                        <option value="">Rating</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>
                    </select>

                    <button class="bg-[#9d8cd9] hover:bg-[#8879bf] dark:bg-[#6163b3] dark:hover:bg-[#505193] w-1/2 px-4 py-2 rounded-lg text-white">
                        Submit Review
                    </button>
                </div>

            </form>
            @endauth


            <div class="flex flex-col sm:flex-row items-center gap-3">

                @forelse($product->reviews as $review)
                <div class="bg-[#1b193b] p-4 rounded-lg shadow w-full h-full">

                    <p class="text-yellow-400 mb-1">
                        {{ str_repeat('⭐', $review->rating) }}
                    </p>

                    <p class="text-white mb-2">
                        {{ $review->comment }}
                    </p>

                    <div class="text-sm text-gray-300">
                        - {{ $review->user?->first_name ?? 'Admin' }}
                    </div>
                </div>
                @empty
                <p class="text-gray-800 dark:text-gray-200">No reviews yet.</p>
                @endforelse

            </div>
        </div>
</section>
@endsection
