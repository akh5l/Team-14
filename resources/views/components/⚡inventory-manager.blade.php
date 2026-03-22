<?php
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use App\Models\StockLog;

new class extends Component {
    use WithFileUploads;

    public string $search = '';
    public string $filter = '';

    public bool $showAlerts = true;
    public bool $showProducts = false;
    public bool $showRestock = false;
    public bool $showReports = false;

    public function getProductsProperty()
    {
        return Product::with('category')
            ->when($this->search, fn($q) => $q->where('product_name', 'like', "%{$this->search}%"))
            ->when($this->filter === 'out_of_stock', fn($q) => $q->where('stock', 0))
            ->when($this->filter === 'low_stock', fn($q) => $q->whereBetween('stock', [1, 15]))
            ->when($this->filter === 'in_stock', fn($q) => $q->where('stock', '>=', 16))
            ->get();
    }

    public function getAlertsProperty()
    {
        return Product::where('stock', '<', 16)->orderBy('stock')->get();
    }

    public string $restockProductId = '';
    public int $restockQuantity = 0;

    public function restock()
    {
        $this->validate([
            'restockProductId' => 'required|exists:products,product_id',
            'restockQuantity'  => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($this->restockProductId);
        $product->increment('stock', $this->restockQuantity);

        StockLog::create([
            'product_id' => $product->product_id,
            'change'     => $this->restockQuantity,
            'reason'     => 'restock',
        ]);

        $this->reset(['restockProductId', 'restockQuantity']);
        session()->flash('success', 'Stock updated.');
    }

    public function addProduct()
    {
        $this->validate([
            'newName'                => 'required|string|max:255',
            'newDescription'         => 'nullable|string',
            'newDescriptionDetailed' => 'nullable|string',
            'newCategoryId'          => 'nullable|exists:categories,category_id',
            'newPrice'               => 'required|numeric|min:0',
            'newStock'               => 'required|integer|min:0',
            'newImage'               => 'nullable|image|max:2048',
        ]);

        $imageUrl = null;
        if ($this->newImage) {
            $path = $this->newImage->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        }

        Product::create([
            'product_name'         => $this->newName,
            'description'          => $this->newDescription,
            'description_detailed' => $this->newDescriptionDetailed,
            'category_id'          => $this->newCategoryId ?: null,
            'price'                => $this->newPrice,
            'stock'                => $this->newStock,
            'image_url'            => $imageUrl,
        ]);

        session()->flash('success', 'Product added.');
    }

    public function deleteProduct()
    {

    }

};
?>

<div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- alerts --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" wire:click="$toggle('showAlerts')">
            <h2 class="text-xl font-semibold text-gray-800 flex items-center gap-2">
                Stock Alerts
                @if($this->alerts->count() > 0)
                <span class="text-sm bg-red-100 text-red-600 px-2 py-0.5 rounded-full">{{ $this->alerts->count() }}</span>
                @endif
            </h2>
            <svg class="{{ $showAlerts ? 'rotate-180' : '' }} w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        @if($showAlerts)
        <div class="px-6 pb-6">
            @forelse($this->alerts as $product)
            <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                <div class="flex items-center gap-3">
                    <img src="{{ $product->image_url }}" class="w-10 h-10 object-contain rounded bg-gray-50">
                    <span class="font-medium">{{ $product->product_name }}</span>
                </div>
                @if($product->stock === 0)
                <span class="text-sm font-semibold text-red-600 bg-red-50 px-3 py-1 rounded-full">Out of stock</span>
                @else
                <span class="text-sm font-semibold text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full">Low stock — {{ $product->stock }} left</span>
                @endif
            </div>
            @empty
            <p class="text-gray-500 text-sm">All products are well stocked.</p>
            @endforelse
        </div>
        @endif
    </div>

    {{-- products --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" wire:click="$toggle('showProducts')">
            <h2 class="text-xl font-semibold text-gray-800">Products</h2>
            <div class="flex items-center gap-3" @click.stop>
                <button class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                    Add Product
                </button>
                <svg class="{{ $showProducts ? 'rotate-180' : '' }} w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
        @if($showProducts)
        <div class="px-6 pb-6">
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">{{ session('success') }}</div>
            @endif
            <div class="flex flex-col md:flex-row gap-3 mb-4">
                <input type="text" wire:model.live.debounce.200ms="search" placeholder="Search products..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                <select wire:model.live="filter" class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                    <option value="">All</option>
                    <option value="in_stock">In Stock</option>
                    <option value="low_stock">Low Stock</option>
                    <option value="out_of_stock">Out of Stock</option>
                </select>
            </div>
            <table class="w-full text-left text-sm text-gray-600">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 pr-4">Product</th>
                        <th class="py-2 pr-4">Category</th>
                        <th class="py-2 pr-4">Price</th>
                        <th class="py-2 pr-4">Stock</th>
                        <th class="py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->products as $product)
                    <tr class="border-b">
                        <td class="py-2 pr-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $product->image_url }}" class="w-10 h-10 object-contain rounded bg-gray-50">
                                <span>{{ $product->product_name }}</span>
                            </div>
                        </td>
                        <td class="py-2 pr-4">{{ $product->category?->category_name ?? '—' }}</td>
                        <td class="py-2 pr-4">£{{ number_format($product->price, 2) }}</td>
                        <td class="py-2 pr-4">
                            @if($product->stock === 0)
                            <span class="text-red-600 font-semibold">Out of stock</span>
                            @elseif($product->stock < 16) <span class="text-yellow-600 font-semibold">Low — {{ $product->stock }}</span>
                                @else
                                <span class="text-green-600">{{ $product->stock }}</span>
                                @endif
                        </td>
                        <td class="py-2 flex gap-2">
                            <button class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">Edit</button>
                            <button wire:click="deleteProduct({{ $product->product_id }})" wire:confirm="Are you sure you want to delete this product?" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 text-gray-400">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @endif
    </div>


    {{-- restocking --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" wire:click="$toggle('showRestock')">
            <h2 class="text-xl font-semibold text-gray-800">Restock</h2>
            <svg class="{{ $showRestock ? 'rotate-180' : '' }} w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        @if($showRestock)
        <div class="px-6 pb-6">
            <div class="flex flex-col md:flex-row gap-3 w-full justify-between items-center">
                <select wire:model="restockProductId" class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                    <option value="">Select a product</option>
                    @foreach(Product::orderBy('product_name')->get() as $product)
                    <option value="{{ $product->product_id }}">{{ $product->product_name }} ({{ $product->stock }} in stock)</option>
                    @endforeach
                </select>
                <input type="number" wire:model="restockQuantity" min="1" placeholder="Quantity" class="w-32 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                <button wire:click="restock" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                    Add Stock
                </button>
            </div>
            @error('restockProductId') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
            @error('restockQuantity') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
        </div>
        @endif
    </div>

    {{-- reports - chart --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" wire:click="$toggle('showReports')">
            <h2 class="text-xl font-semibold text-gray-800">Reports</h2>
            <svg class="{{ $showReports ? 'rotate-180' : '' }} w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        @if($showReports)
        <div class="px-6 pb-6">
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="bg-gray-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-500 mb-1">Total Products</p>
                    <p class="text-2xl font-bold text-gray-800">—</p>
                </div>
                <div class="bg-yellow-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-500 mb-1">Low Stock</p>
                    <p class="text-2xl font-bold text-yellow-600">—</p>
                </div>
                <div class="bg-red-50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-500 mb-1">Out of Stock</p>
                    <p class="text-2xl font-bold text-red-600">—</p>
                </div>
            </div>
            <div class="mb-6">
                <h3 class="text-md font-semibold text-gray-700 mb-3">Stock Changes</h3>
                <canvas id="stockChart" class="w-full" height="100"></canvas>
            </div>
            <h3 class="text-md font-semibold text-gray-700 mb-3">Stock Log</h3>
            <table class="w-full text-left text-sm text-gray-600">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 pr-4">Product</th>
                        <th class="py-2 pr-4">Change</th>
                        <th class="py-2 pr-4">Reason</th>
                        <th class="py-2">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="py-4 text-gray-400">No stock changes recorded yet.</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
