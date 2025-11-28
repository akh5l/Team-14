<a href="{{ route('products.show', $product->product_id) }}"
    class="hover:scale-105 transform transition-all duration-300 active:scale-100 hover:tracking-wide variable-card">
    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col h-full">
        <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}"
            class="h-48 w-full object-contain bg-gray-100 rounded mb-4" />

        <h3 class="text-xl font-semibold mb-2">{{ $product->product_name }}</h3>

        <p class="text-gray-700 mb-2 text-sm flex-grow" style="font-weight: 500">{{ $product->description }}</p>

        <p class="text-red-500 mb-4 text-lg mt-auto">
            £{{ number_format($product->price, 2) }}
        </p>

        <div
            class="mt-auto bg-gray-800 text-white text-center py-2 px-4 rounded hover:bg-gray-700 font-semibold transition">
            View Product</div>
    </div>
</a>
