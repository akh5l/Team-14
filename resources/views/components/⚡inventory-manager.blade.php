<?php
use Livewire\Component;

new class extends Component {
};
?>

<div x-data="{
    sections: { alerts: true, products: true, restock: false, reports: false },
    toggle(s) { this.sections[s] = !this.sections[s]; }
}">

    {{-- alerts --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" @click="toggle('alerts')">
            <h2 class="text-xl font-semibold text-gray-800">Stock Alerts</h2>
            <svg :class="sections.alerts ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        <div x-show="sections.alerts" class="px-6 pb-6">
            <p class="text-gray-500 text-sm">No alerts yet.</p>
        </div>
    </div>

    {{-- products --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" @click="toggle('products')">
            <h2 class="text-xl font-semibold text-gray-800">Products</h2>
            <div class="flex items-center gap-3" @click.stop>
                <button class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700">
                    Add Product
                </button>
                <svg :class="sections.products ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>
        <div x-show="sections.products" class="px-6 pb-6">
            <div class="flex flex-col md:flex-row gap-3 mb-4">
                <input type="text" placeholder="Search products..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                <select class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
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
                    <tr>
                        <td colspan="5" class="py-4 text-gray-400">No products yet.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- restocking --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" @click="toggle('restock')">
            <h2 class="text-xl font-semibold text-gray-800">Restock</h2>
            <svg :class="sections.restock ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        <div x-show="sections.restock" class="px-6 pb-6">
            <div class="flex flex-col md:flex-row gap-3 max-w-lg">
                <select class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                    <option value="">Select a product</option>
                </select>
                <input type="number" min="1" placeholder="Quantity" class="w-32 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none">
                <button class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
                    Add Stock
                </button>
            </div>
        </div>
    </div>

    {{-- reports - chart? --}}
    <div class="mb-6 bg-white shadow rounded-lg border border-gray-100">
        <div class="p-6 flex justify-between items-center cursor-pointer" @click="toggle('reports')">
            <h2 class="text-xl font-semibold text-gray-800">Reports</h2>
            <svg :class="sections.reports ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
        <div x-show="sections.reports" class="px-6 pb-6">
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
    </div>
</div>