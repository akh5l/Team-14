<a href="{{ route('products.show', $product->product_id) }}"
    class="hover:scale-105 active:scale-100 product-card">
    <div class="bg-[#e5e0f7] dark:bg-[#2c2f66] rounded-lg shadow hover:shadow-lg p-4 flex flex-col h-full">
        <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}"
            class="h-48 w-full object-contain rounded mb-4 bg-white" />

        <h3 class="text-xl dark:text-white font-semibold mb-2">{{ $product->product_name }}</h3>

        <p class="text-gray-600 dark:text-gray-300 mb-2 text-sm flex-grow" style="font-weight: 500">{{ $product->description }}</p>

        <p class="text-red-500 mb-4 text-lg mt-auto">
            £{{ number_format($product->price, 2) }}
        </p>

        <div
            class="mt-auto bg-[#9d8cd9] hover:bg-[#8b7ebd] dark:bg-[#6163b3] dark:hover:bg-[#53549d] text-white text-center py-2 px-4 rounded hover:bg-gray-700 font-semibold transition">
            View Product</div>
    </div>
</a>
