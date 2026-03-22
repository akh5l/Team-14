@extends('layouts.app')

@section('content')
<section class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-8">

        <div class="md:w-1/2">
            <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow" />
        </div>

        <div class="md:w-1/2 flex flex-col justify-center">
            <h1 class="text-4xl font-bold mb-4">{{ $product->product_name }}</h1>
            <p class="text-lg mb-4">{{ $product->description }}</p>

            <p class="text-2xl font-semibold mb-6 text-red-500">
                £{{ number_format($product->price, 2) }}
            </p>

            <div class="flex space-x-4">

                @auth
                @if ($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button type="submit" class="bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition font-semibold">
                        Add to Cart
                    </button>
                </form>

                <form method="POST" action="{{ route('cart.buyNow', $product) }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition font-semibold">
                        Buy Now
                    </button>
                </form>
                @else
                <button class="bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition font-semibold">
                    Out of stock
                </button>
                @endif
                @endauth

                @guest
                <a href="/login" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition font-semibold">
                    Sign in to buy
                </a>
                @endguest
            </div>
            <p class="text-md border-2 rounded-lg mt-12 p-10 mr-10">{{ $product->description_detailed }}</p>
        </div>
    </div>
</section>
<hr class="mx-20">
<section class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold mb-8 text-center">Product Details & Reviews</h2>

    <div class="grid md:grid-cols-2 gap-8">

        <div>
            <h3 class="text-2xl font-semibold mb-4">Product Details</h3>

            <ul class="list-disc list-inside mb-4">

                @if ($product->stock == 0)
                <li>Currently out of stock - please check again soon</li>
                @elseif ($product->stock == 1)
                <li>Grab it now - only 1 unit remaining!</li>
                @elseif ($product->stock < 16) <li>Grab it now - only {{ $product->stock }} units remaining!</li>
                    @else
                    <li class="">In stock</li>
                    @endif
                    <hr class="my-2 mx-2">
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
                    <hr class="my-2 mx-2">
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

        <div class="border-2 rounded-lg p-3">
            <h3 class="text-2xl font-semibold mb-4">Customer Reviews</h3>

            @auth
            <form method="POST" action="{{ route('reviews.store', $product->product_id) }}">
                @csrf

                <textarea name="comment" class="w-full bg-gray-100 dark:bg-gray-300 border border-gray-300 text-gray-800 dark:text-black placeholder-gray-600 dark:placeholder-gray-800 rounded-lg px-4 py-2 mb-3" placeholder="Write your review..." required></textarea>

                <div class="flex flex-col sm:flex-row gap-3 mb-8">
                    <select name="rating" class="w-1/2 bg-gray-100 dark:bg-[#292755] border dark:border-[#6163b3] text-gray-800 dark:text-gray-200 rounded-lg px-4 py-2" required>
                        <option value="">Rating</option>
                        <option value="5">⭐⭐⭐⭐⭐</option>
                        <option value="4">⭐⭐⭐⭐</option>
                        <option value="3">⭐⭐⭐</option>
                        <option value="2">⭐⭐</option>
                        <option value="1">⭐</option>
                    </select>

                    <button class="bg-blue-500 dark:bg-[#6163b3] w-1/2 px-4 py-2 rounded-lg text-white">
                        Submit Review
                    </button>
                </div>

            </form>
            @endauth

            <div class="flex flex-col sm:flex-row items-center gap-3">
                @forelse($product->reviews as $review)
                <div class="bg-gray-100 dark:bg-[#1a173b] p-4 rounded-lg shadow w-full h-full">
                    <div class="flex justify-between items-start mb-1">
                        <p class="text-yellow-400">
                            {{ str_repeat('⭐', $review->rating) }}
                        </p>
                        @if (auth()->user()->role === 'admin')
                        <form method="POST" action="/reviews/{{ $review->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                    <p class="text-black dark:text-white mb-2">
                        {{ $review->comment }}
                    </p>
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        - {{ $review->user?->first_name ?? 'Admin' }}
                    </div>
                </div>
                @empty
                <p class="text-gray-800 dark:text-gray-300">No reviews yet.</p>
                @endforelse
            </div>
        </div>
</section>
@endsection
