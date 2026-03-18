@extends('layouts.app')

@section('content')
<main class="max-w-6xl mx-auto px-4 py-8 flex-grow">
    <h1 class="text-3xl font-bold mb-6">Order History</h1>
    @if ($orders->count()>0)
        <div class ="space-y-6">
            @foreach ($orders as $order)
                <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                        <div>
                            <p class="font-semibold text-xl">Order #{{ $order->order_id }}</p>
                            <p class="text-sm text-gray-600">Date: {{ $order->order_date}}</p>
                            <p class="text-sm text-gray-600">Status: {{ $order->order_status}}</p>
                            <p class="text-sm text-gray-600">Payment Method: {{ $order->payment_method}}</p>
                        </div>

                        <div class="text-left md:text-right">
                            <p class="font-semibold text-lg"> £{{ number_format($order->total_amount, 2) }}</p>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h2 class="font-semibold mb-3">Order Items:</h2>
                    <div class="space-y-4">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-start border-b pb-3">
                                <div>
                                    <p class="font-medium"> {{ $item->product ? $item->product->product_name : 'Product is not available' }} </p>
                                    <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    <p class="text-sm text-gray-500">Price: £{{ number_format($item->price, 2) }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-medium"> £{{ number_format($item->price * $item->quantity, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @else
            <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                <p class="text-gray-600"> No orders have been placed.</p>
            </div>
        @endif
</main>
@endsection