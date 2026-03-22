<?php

use Livewire\Component;
use App\Models\Product;

new class extends Component {
    public string $search = '';
    public $categories;

    public function getProductsProperty()
    {
        return Product::query()
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($q2) use ($search) {
                            $q2->where('category_name', 'like', "%{$search}%");
                        });
                });
            })
            ->get();
    }
};
?>

<div>
    <div class="max-w-md mx-auto mb-8">
        <input type="text" placeholder="Search for products!" wire:model.live.debounce.200ms="search" autofocus
            class="w-full h-12 px-4 py-2 rounded-full">
    </div>

    <div class="flex flex-wrap justify-center gap-4 mb-8">
        <button wire:click="$set('search', '')"
            class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
            All Products
        </button>

        @foreach ($this->categories as $category)
            <button wire:click="$set('search', '{{ addslashes($category->category_name) }}')"
                class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 transition">
                {{ $category->category_name }}
            </button>
        @endforeach
    </div>

    <div class="grid md:grid-cols-3 gap-8">
        @forelse ($this->products as $product)
            @include('products.partials.product-card', ['product' => $product])
        @empty
            <p class="col-span-3 text-center text-gray-500">
                No products found.
            </p>
        @endforelse
    </div>
</div>
