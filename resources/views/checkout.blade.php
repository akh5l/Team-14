@extends('layouts.app')
@section('content')
    <!--Tailwind Cheat Sheet: https://nerdcave.com/tailwind-cheat-sheet*-->
    <section class="max-w-6xl mx-auto px-4 py-8 flex-grow">
        <h1 class = "text-3xl font-bold mb-6">Checkout</h1>
        <div class="md:grid md:grid-cols-3 gap-6 items-start">
            <div class="bg-white rounded-lg shadow p-4 md:p-6 md:col-span-1 border border-gray-100">
                <div class="flex flex-col md:flex-row gap-4">

                    <div class="bg-white rounded-lg shadow p-4 md:p-6 md:col-span-1 border border-gray-100">
                        <div class="flex flex-col md:flex-row gap-4">
                            <!-- the example image and the propterties of it too -->
                            <div class="flex gap-4">
                                <img src="/images/products/d&d.png" alt="Product Image"
                                    class="w-24 h-28 object-contain rounded bg-gray-100">
                                <div>
                                    <p class="font-semibold text-xl"> D&D Dragons of Stormwreck Isle Starter Set</p>
                                    <p class="text-gray-600 text-sm"> Product #: 12345</p>
                                    <div class="mt-3 flex items-center gap-2">
                                        <span class="text-sm">Quantity:</span>
                                        <input id="quantity" type="number" min="1" value="1"
                                            class="w-16 border border-gray-300 rounded px-2 py-1 text-center text-sm">
                                    </div>
                                </div>

                                <!-- pricing and removing item button -->
                                <div class="text-right">
                                    <p id="line-total" class="font-semibold text-lg">£19.99</p>
                                    <button class="text-xs text-blue-600 hover:underline mt-1">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
