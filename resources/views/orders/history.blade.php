@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-4 py-8 flex-grow">
    <h1 class="text-3xl font-bold mb-6">Order History</h1>
    @if ($orders->count()>0)
    <div class="space-y-6">
        @foreach ($orders as $order)
        <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                <div>
                    <p class="font-semibold text-3xl mb-2">Order #{{ $loop->count - $loop->iteration + 1 }}</p> 
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
    
    {{-- success modal after checkout --}}
    <div id="successModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center modal-show">
            <h2 class="text-xlfont-semibold text-green-600 mb-4">Checkout processed!</h2>
            <p class="text-sm text-gray-700 mb-6">Thank you for checking out with Bridge 14 games!<br>Your order is being
                processed.<br>A confirmation email will be sent shortly.</p>

            <button id="successModalClose" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold">
                Understood!
            </button>
        </div>
    </div>

    <style>
        .modal-show {
            opacity: 0;
            transform: scale(0.95);
            animation: popupFade 0.25s ease-out forwards;
            /*animation for popup */
        }

        @keyframes popupFade {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

    </style>

    <script>
        @if(session('success'))
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("successModal");

            if (!modal) return;

            // show success modal
            modal.classList.remove("hidden");

            // close button
            document.getElementById("successModalClose").addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        });
        @endif

    </script>
</section>
@endsection
