@extends('layouts.app')

@section('content')

    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row gap-8">

            <div class="md:w-1/2">
                <img src="{{ asset($product->image_url) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-auto rounded-lg shadow" />
            </div>

            <div class="md:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl font-bold mb-4">{{ $product->product_name }}</h1>
                <p class="text-lg mb-4">{{ $product->description }}</p>

                <p class="text-2xl font-semibold mb-6 text-red-500">
                    £{{ number_format($product->price, 2) }}
                </p>

                <div class="flex space-x-4">
                    <a href="#"
                        class="bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition font-semibold">
                        Add to Cart
                    </a>

                    <a href="#"
                        class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition font-semibold">
                        Buy Now
                    </a>
                </div>
            </div>

        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8 text-center">Product Details & Reviews</h2>

        <div class="grid md:grid-cols-2 gap-8">

            <div>
                <h3 class="text-2xl font-semibold mb-4">Product Details</h3>
                <p class="mb-4">
                    {{ $product->detailed_description ?? 'PLACEHOLDER add a detailed description field to each product, using Braden\'s trello descriptions!!!' }}
                </p>

                <ul class="list-disc list-inside mb-4">
                    <li>PLACEHOLDER Make this list specific to each product?</li>
                    <li>Durable materials</li>
                    <!-- If a product is above £40, add a section under 'product details' stating that is eligible for free delivery -->
                    @if($product->price > 40)
                        <li>Eligible for free delivery</li>
                    @endif
                </ul>
            </div>

            <div>
                <h3 class="text-2xl font-semibold mb-4">Customer Reviews</h3>
                <div class="space-y-4">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="mb-2">"Great product; highly recommend"</p>
                        <div class="text-sm text-gray-600">- customer 1 PLACEHOLDER add dummy reviews from customers later</div>
                    </div>

                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="mb-2">"Good quality and fast shipping"</p>
                        <div class="text-sm text-gray-600">- customer 2</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
