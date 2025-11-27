@extends('layouts.app')
@section('content')

    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-1/2">
                <img src="#" alt="Product Image" class="w-full h-auto rounded-lg shadow" />
            </div>
            <div class="md:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl font-bold mb-4">Product Name</h1>
                <p class="text-lg mb-4">A detailed description of the product goes here.</p>
                <p class="text-2xl font-semibold mb-6 text-red-500">£49.99</p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition font-semibold">Add
                        to Cart</a>
                    <a href="#"
                        class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 transition font-semibold">Buy
                        Now</a>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold mb-8 text-center">Product Details & Reviews</h2>
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-2xl font-semibold mb-4">Product Details</h3>
                <p class="mb-4"> Further details of said product goes here, including its features:</p>
                <ul class="list-disc list-inside mb-4">
                    <li>Feature 1</li>
                    <li>Feature 2</li>
                    <li>Feature 3</li>
                </ul>
            </div>
            <div>
                <h3 class="text-2xl font-semibold mb-4">Customer Reviews</h3>
                <div class="space-y-4">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <p class="mb-2">"Great product; highly recommend"</p>
                        <div class="text-sm text-gray-600">- customer 1</div>
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