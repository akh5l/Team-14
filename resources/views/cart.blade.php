@extends('layouts.app')
@section('content')

    <main class="max-w-6xl mx-auto px-4 py-8 flex-grow">
        <h1 class="text-3xl font-bold mb-6">Your Shopping Cart</h1>
        <div class="lg:grid lg:grid-cols-3 gap-6 items-start">

            <div class="bg-white rounded-lg shadow p-4 md:col-span-1 border border-gray-100 space-y-4">
                @php
                    $cart = session()->get('cart', []);
                @endphp

                @if (count($cart) > 0)
                    @foreach ($cart as $item)
                        <div class="flex flex-col md:flex-row gap-4 cart-item" data-price="{{ $item['price'] }}"
                            data-quantity="{{ $item['quantity'] }}">
                            <div class="flex flex-1 gap-4 mr-20">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['product_name'] }}"
                                    class="w-24 h-28 object-contain rounded bg-gray-100">
                                <div>
                                    <p class="font-semibold text-xl">{{ $item['product_name'] }}</p>
                                    <form action="{{ route('cart.update', ['productId' => $item['product_id']]) }}"
                                        method="POST" class="mt-2 flex items-center space-x-2">
                                        @csrf
                                        <label class="text-md text-black"> Quantity:</label>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                            class="w-14 border border-gray-300 rounded px-2 py-1 text-sm"
                                            onchange="setTimeout(() => this.form.submit(), 300)">
                                    </form>
                                </div>
                            </div>

                            <div class="text-right flex-col">
                                <p class="font-semibold text-lg">£{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </p>
                                <form action="{{ route('cart.remove', ['productId' => $item['product_id']]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="text-xs text-red-600 hover:underline mt-1">Remove</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>

            <div class="mt-6 md:mt-0 md:col-span-2 md:pl-4">
                <div class="bg-white p-6 rounded-lg shadow-md">

                    <p class="text-2xl font-bold mb-4 text-center">Choice of Delivery</p>
                    <div class="flex flex-wrap gap-3 items-start justify-center">
                        <label
                            class="delivery-option flex flex-col justify-center bg-gray-100 hover:bg-gray-200 border rounded-lg px-4 py-3 cursor-pointer min-w-[140px] hover:scale-105 hover:shadow-lg active:scale-100 transition transform duration-200 rounded-lg shadow-md">
                            <input type="radio" name="delivery" value="2.99" class="hidden" checked>
                            <div>
                                <span class="text-sm font-medium">Standard</span><br>
                                <span class="text-sm text-gray-600">(3-5 business days) £2.99</span>
                            </div>
                        </label>
                        <label
                            class="delivery-option flex flex-col justify-center bg-gray-100 hover:bg-gray-200 border rounded-lg px-4 py-3 cursor-pointer min-w-[140px] hover:scale-105 hover:shadow-lg active:scale-100 transition transform duration-200 rounded-lg shadow-md">
                            <input type="radio" name="delivery" value="4.99" class="hidden">
                            <div>
                                <span class="text-sm font-medium">Express</span><br>
                                <span class="text-sm text-gray-600">(1-3 business days) £4.99</span>
                            </div>
                        </label>
                        <label
                            class="delivery-option flex flex-col justify-center bg-gray-100 hover:bg-gray-200 border rounded-lg px-4 py-3 cursor-pointer min-w-[140px] hover:scale-105 hover:shadow-lg active:scale-100 transition transform duration-200 rounded-lg shadow-md">
                            <input type="radio" name="delivery" value="0.00" class="hidden">
                            <div>
                                <span class="text-sm font-medium">Click & Collect</span><br>
                                <span class="text-sm text-gray-600">(0-1 business days) £0.00</span>
                            </div>
                        </label>
                    </div>

                    @php
                        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
                    @endphp

                    <hr class="my-4">
                    <div class="mt-4">
                        <p id="free-shipping-text" class= "text-md text-black mb-2">
                            £{{ number_format(max(40 - $subtotal, 0), 2) }} away from free shipping!
                        </p>
                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                            <div id="free-shipping-bar" class="bg-blue-500 h-3 rounded-full transition-all duration-300"
                                style="width: 0%"></div>
                        </div>
                    </div>

                    <div class="my-4 text-sm space-y-1">
                        <div class="mt-2 flex justify-between">
                            <span>Your Subtotal:</span>
                            <span id="subtotal">£{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <hr>
                        <div class="mt-2 flex justify-between">
                            <span>Your Delivery:</span>
                            <span id="delivery">£0.00</span>
                        </div>
                        <hr>
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total:</span>
                            <span id="total">£{{ number_format($subtotal, 2) }}</span>
                        </div>

                        <button onclick="window.location.href='{{ route('checkout.index') }}'"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-lg text-white py-2.5 rounded-lg font-semibold hover:scale-105 hover:shadow-lg active:scale-100 transition transform duration-200 rounded-lg shadow-md">
                            Proceed to Checkout
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <script>
        const FREE_SHIPPING_THRESHOLD = 40;

        function updateTotals() {
            const cartItems = document.querySelectorAll(".cart-item");
            let subtotal = 0;

            cartItems.forEach(item => {
                const price = parseFloat(item.dataset.price);
                const qty = parseInt(item.dataset.quantity) || 1;
                subtotal += price * qty;

                // line total
                // const lineTotalEl = item.querySelector(".line-total");
                // lineTotalEl.textContent = "£" + (price * qty).toFixed(2);
            });

            // delivery cost
            const deliveryRadios = document.querySelectorAll("input[name='delivery']");
            let deliveryCost = 0;
            deliveryRadios.forEach(radio => {
                if (radio.checked) deliveryCost = parseFloat(radio.value);
            });

            if (subtotal === 0) {
                deliveryCost = 0;
            }

            // apply free shipping if subtotal >= threshold
            if (subtotal >= FREE_SHIPPING_THRESHOLD) deliveryCost = 0;

            // update DOM
            document.getElementById("subtotal").textContent = "£" + subtotal.toFixed(2);
            document.getElementById("delivery").textContent = "£" + deliveryCost.toFixed(2);
            document.getElementById("total").textContent = "£" + (subtotal + deliveryCost).toFixed(2);

            // store totals
            // document.getElementById("checkoutSubtotal").value = subtotal.toFixed(2);
            // document.getElementById("checkoutDelivery").value = deliveryCost.toFixed(2);
            // document.getElementById("checkoutTotal").value = (subtotal + deliveryCost).toFixed(2);

            // free shipping bar
            const freeShippingText = document.getElementById("free-shipping-text");
            const freeShippingBar = document.getElementById("free-shipping-bar");
            if (freeShippingText && freeShippingBar) {
                let percent = (subtotal / FREE_SHIPPING_THRESHOLD) * 100;
                percent = Math.min(Math.max(percent, 0), 100);
                freeShippingBar.style.width = percent + "%";

                if (subtotal >= FREE_SHIPPING_THRESHOLD) {
                    freeShippingText.textContent = "Free shipping applied!";
                } else {
                    freeShippingText.textContent = "£" + (FREE_SHIPPING_THRESHOLD - subtotal).toFixed(2) +
                        " away from free shipping!";
                }
            }
        }

        // Attach event listeners to quantity inputs
        document.querySelectorAll("input[name='quantity']").forEach(input => {
            input.addEventListener("input", function() {
                const cartItem = input.closest(".cart-item");
                if (cartItem) {
                    cartItem.dataset.quantity = input.value;
                }
                updateTotals();
            });
        });

        // Attach event listeners to delivery options
        document.querySelectorAll("input[name='delivery']").forEach(radio => {
            radio.addEventListener("change", updateTotals);
        });

        // Run on page load
        updateTotals();
    </script>


@endsection
