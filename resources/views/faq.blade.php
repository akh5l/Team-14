@extends('layouts.app')
@section('content')
<main class="max-w-6xl mx-auto px-4 py-8 my-[8rem] flex-grow">
    <h1 class="text-3xl font-bold mb-6 text-center">Frequently Asked Questions (FAQ)</h1>

    <div class="flex flex-col items-center space-y-4">
        @php
            $faqs = [
                ['question' => 'Do you offer official Nintendo products?', 
                 'answer' => 'Yes, we are an authorized retailer of official Nintendo products, including consoles, games, and accessories.'],

                ['question' => 'Do you sell games for all consoles?', 
                 'answer' => 'While we don\'t sell games for every console, we offer a wide selection of games for multiple current-generation consoles - including the latest releases and popular titles.'],

                ['question' => 'What is your return policy?', 
                 'answer' => 'We accept returns within 30 days of purchase for unopened and unused items. Please refer to our return policy page for more details.'],

                ['question' => 'Do you offer in-store pickup?', 
                 'answer' => 'Yes, you can choose the in-store pickup option during checkout for online orders. We will notify you when your order is ready.'],

                ['question' => 'Do you offer gift wrapping services?', 
                 'answer' => 'Unfortunately, we do not offer gift wrapping services at the time. However, please keep an eye out for when we do!'],
            ];
        @endphp

        @foreach($faqs as $faq)
        <div class="bg-white rounded-lg shadow p-6 border border-gray-100 w-2/3">
            <details class="group">
                <summary class="flex justify-between items-center cursor-pointer font-semibold">
                    {{ $faq['question'] }}
                    <span class="text-lg transition-transform group-open:rotate-180 duration-500">▼</span>
                </summary>
                <p class="mt-2 text-md text-black max-h-0 overflow-hidden group-open:max-h-96 transition-all duration-300">
                    {{ $faq['answer'] }}
                </p>
            </details>
        </div>
        @endforeach
    </div>

    <div class="mt-6 text-s text-gray-800 text-center">
        Still have questions? 
        <a href="/contact-us" class="text-blue-600 hover:underline">Contact our support team</a> for further assistance.
    </div>
</main>
@endsection
