@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-4 py-12 flex-grow">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-5">
        <h1 class="text-4xl font-bold mb-6">Order History</h1>
        <div class="flex gap-3 mt-4 md:mt-0">
            <button onclick="openReturnModal()" class="w-full mb-3 md:w-auto px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg shadow-lg hover:bg-blue-700 transition transform hover:-translate-y-1">
                Return Items
            </button>
        </div>
    </div>

    @if ($orders->count()>0)
    <div class="space-y-6">
        @foreach ($orders as $order)
        <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
            <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4 mb-4">
                <div>
                    <p class="font-semibold text-3xl mb-2">Order #{{ $loop->count - $loop->iteration + 1 }}</p>
                    <p class="text-md text-black">Date: {{ $order->order_date}}</p>
                    <p class="text-md text-gray-600">Status: {{ $order->order_status}}</p>
                    <p class="text-md text-gray-600">Payment Method: {{ $order->payment_method}}</p>
                    <p class="text-md mt-2 text-gray-600">Address:</p>
                    <p class="text-md px-3 text-gray-600">{{ $order->address_line1 }}</p>
                    <p class="text-md px-3 text-gray-600">{{ $order->address_line2 }}</p>
                    <p class="text-md px-3 text-gray-600">{{ $order->city }}</p>
                    <p class="text-md px-3 text-gray-600">{{ $order->postcode }}</p>
                </div>

                <div class="text-left md:text-right">
                    <p class="font-semibold text-lg"> £{{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>
            <hr class="my-4">
            <h2 class="font-semibold mb-3">Order Items:</h2>
            <div class="space-y-4">
                @foreach ($order->items as $item)
                <div class="flex justify-between items-start border-b pb-3 px-3">
                    <div>
                        <p class="text-md"> {{ $item->product ? $item->product->product_name : 'Product is not available' }} </p>
                        <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                        <p class="text-sm text-gray-600">Price: £{{ number_format($item->price, 2) }}</p>
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

    {{-- return orderItems modal --}}
    <div id="returnModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg modal-show">
            <h2 class="text-xl font-semibold mb-4">Return Items</h2>

            {{-- order selection --}}
            <div id="returnStep1">
                <p class="text-sm text-black mb-3">Select an order to return items from:</p>
                <div class="space-y-2 max-h-72 overflow-y-auto">
                    @foreach($orders as $order)
                    @php
                    $returnable = $order->order_status === 'delivered' &&
                    $order->order_date->diffInDays(now()) <= 30 && $order->items->contains(fn($i) => !$i->returned); // cheeky lambda
                        @endphp
                        <button @if($returnable) onclick="selectOrder({{ $order->id }})" @else disabled @endif class="w-full text-left px-4 py-3 rounded-lg border
                            {{ $returnable ? 'hover:bg-gray-50 cursor-pointer border-gray-200' : 'opacity-40 cursor-not-allowed border-gray-100 bg-gray-50' }}">
                            <p class="font-medium">Order #{{ $loop->count - $loop->iteration + 1 }}</p>
                            <p class="text-sm text-gray-500">{{ $order->order_date }} · £{{ number_format($order->total_amount, 2) }}</p>
                            @if(!$returnable)
                            <p class="text-xs text-red-400 mt-1">
                                @if($order->order_status !== 'delivered')
                                Not yet delivered
                                @elseif($order->order_date->diffInDays(now()) > 30)
                                Return window has passed
                                @else
                                All items already returned
                                @endif
                            </p>
                            @endif
                        </button>
                        @endforeach
                </div>
                <button onclick="closeReturnModal()" class="mt-4 w-full px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-black">
                    Cancel
                </button>
            </div>

            {{-- item selection --}}
            <div id="returnStep2" class="hidden">
                <button onclick="backToStep1()" class="text-sm text-blue-600 hover:underline mb-3 inline-block">← Back</button>
                <p class="text-sm text-black mb-3">Select items to return:</p>
                <form method="POST" action="{{ route('orders.return') }}">
                    @csrf
                    <div id="returnItemsList" class="space-y-2 max-h-64 overflow-y-auto mb-4"></div>
                    <button type="submit" onclick="return confirm('Are you sure you want to return the selected items?')" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">
                        Confirm Return
                    </button>
                    <button type="button" onclick="closeReturnModal()" class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600">
                        Cancel
                    </button>
                </form>
            </div>
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

        // return orderItems modal JS
        const ordersData = @json($ordersJson);

        function openReturnModal() {
            document.getElementById('returnModal').classList.remove('hidden');
            document.getElementById('returnStep1').classList.remove('hidden');
            document.getElementById('returnStep2').classList.add('hidden');
        }

        function closeReturnModal() {
            document.getElementById('returnModal').classList.add('hidden');
        }

        function selectOrder(orderId) {
            const order = ordersData.find(o => o.id === orderId);
            if (!order) return;

            const list = document.getElementById('returnItemsList');
            list.innerHTML = '';

            order.items.forEach(item => {
                if (!item.returned) {
                    list.innerHTML += `
                    <label class="flex items-center gap-3 px-4 py-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox" name="item_ids[]" value="${item.id}" class="w-4 h-4">
                        <div>
                            <p class="text-sm font-medium">${item.name}</p>
                            <p class="text-xs text-gray-500">Qty: ${item.quantity}</p>
                        </div>
                    </label>`;
                }
            });

            document.getElementById('returnStep1').classList.add('hidden');
            document.getElementById('returnStep2').classList.remove('hidden');
        }

        function backToStep1() {
            document.getElementById('returnStep2').classList.add('hidden');
            document.getElementById('returnStep1').classList.remove('hidden');
        }

    </script>

</section>
@endsection
