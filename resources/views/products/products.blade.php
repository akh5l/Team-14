@extends('layouts.app')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center mb-8">All Products</h1>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($products as $product)
                <a href="{{ route('products.show', $product->product_id) }}">
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col h-full">
                        <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}"
                            class="h-48 w-full object-contain bg-gray-100 rounded mb-4" />

                        <h3 class="text-xl font-semibold mb-2">{{ $product->product_name }}</h3>

                        <p class="text-gray-700 mb-2 text-sm flex-grow">{{ $product->description }}</p>

                        <p class="text-red-500 mb-4 text-lg mt-auto">
                            £{{ number_format($product->price, 2) }}
                        </p>

                        <div
                            class="mt-auto bg-gray-800 text-white text-center py-2 px-4 rounded hover:bg-gray-700 font-semibold transition">
                            View Product</div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
