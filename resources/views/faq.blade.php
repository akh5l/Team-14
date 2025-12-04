@extends('layouts.app')
@section('content')
    <main class="max-w-6x1 mx auto px-4 py-8 flex-grow">
        <h1 class = "text-3x1 font-bold mb-6">Frequently Asked Questions (FAQ)</h1>

        <div class = "md:grid-cols-3 gap-6 items-start">
            <div class="md:col-span-2 space-y-4">

                <div class="bg-white rounded-lg shadow p-4 md:p-6 border border-gray-100">
                    <details class="group">
                        <summary class ="flex justify-between items-center cursor-pointer font-semibold">
                            Do you offer official Nintendo products?
                            <span class="text-lg transition group-open:rotate-180">▼</span>
                        </summary>
                        <p class ="mt-2 text-sm text gray-600">
                            Yes, we are an authorized retailer of official Nintendo products, including consoles, games, and accessories.
                        </p>
                    </details>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6 border border-gray-100">
                    <details class="group">
                        <summary class ="flex justify-between items-center cursor-pointer font-semibold">
                            Do you sell games for all consoles?
                            <span class="text-lg transition group-open:rotate-180">▼</span>
                        </summary>
                        <p class ="mt-2 text-sm text gray-600">
                            Yes, we offer a wide selection of games for a plethora of consoles, including the latest releases and popular titles.
                        </p>
                    </details>  
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6 border border-gray-100">
                    <details class="group">
                        <summary class ="flex justify-between items-center cursor-pointer font-semibold">
                            What is your return policy?
                            <span class="text-lg transition group-open:rotate-180">▼</span>
                        </summary>
                        <p class ="mt-2 text-sm text gray-600">
                            We accept returns within 30 days of purchase for unopened and unused items. Please refer to our return policy page for more details.        
                        </p>
                    </details>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6 border border-gray-100">
                    <details class="group">
                        <summary class ="flex justify-between items-center cursor-pointer font-semibold">
                            Do you offer in-store pickup?
                            <span class="text-lg transition group-open:rotate-180">▼</span>
                        </summary>
                        <p class ="mt-2 text-sm text gray-600">
                            Yes, you can choose the in-store pickup option during checkout for online orders. We will notify you when your order is ready for pickup.
                        </p>
                    </details>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6 border border-gray-100">
                    <details class="group">
                        <summary class ="flex justify-between items-center cursor-pointer font-semibold">
                            Do you offer gift wrapping services?
                            <span class="text-lg transition group-open:rotate-180">▼</span>
                        </summary>
                        <p class ="mt-2 text-sm text gray-600">
                            Yes, we offer gift wrapping services for a small fee. You can select this option during checkout.
                        </p>
                    </details>
                </div>
            </div>
        </div>
        
    <div class ="mt-6 text-xs text-gray-500">
        Still have questions? <a href="/contact-us" class="text-blue-600 hover:underline">Contact our support team</a> for further assistance.
    </div>
</main>
@endsection
        

            