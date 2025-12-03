@extends('layouts.app')
@section('content')

    <!--Tailwind Cheat Sheet: https://nerdcave.com/tailwind-cheat-sheet*-->
    <main class="max-w-6xl mx-auto px-4 py-8 flex-grow">
        <h1 class = "text-3xl font-bold mb-6">Your Shopping Cart</h1>
        <div class="md:grid md:grid-cols-3 gap-6 items-start">

            <!-- added cart items will go here (on the left side of page)-->
            <div class="bg-white rounded-lg shadow p-4 md:p-6 md:col-span-1 border border-gray-100">
                    <div class="flex flex-col md:flex-row gap-4">
                        <!-- the example image and the propterties of it too -->
                         <div class="flex gap-4">
                            <img src="/images/products/d&d.png" alt="Product Image" class="w-24 h-28 object-contain rounded bg-gray-100">
                            <div>
                                <p class="font-semibold text-xl"> D&D Dragons of Stormwreck Isle Starter Set</p>
                                <p class="text-gray-600 text-sm"> Product #: 12345</p>
                                <div class="mt-3 flex items-center gap-2">
                                    <span class="text-sm">Quantity:</span>
                                    <input
                                        id="quantity"
                                        type="number"
                                        min="1"  
                                        value="1"
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

        <!-- Summary of cart section here (right side) -->
        <div class="mt-6 md:mt-0 md:col-span-2 md:pl-4">
            <div class="bg-white p-6 rounded-lg shadow-md">

                <!-- https://flowbite.com/docs/forms/radio/ radio types following horizontal example-->
                <p class="text-2x1 font-bold mb-4 text-center">Choice of Delivery</p>

                <div class="flex flex-wrap gap-3 items-start justify-center">
                    <!-- Standard -->
                    <label
                        class="delivery-option flex flex-col justify-center bg-gray-100 hover:bg-gray-200 border rounded-lg px-4 py-3 cursor-pointer min-w-[140px]">
                        <input type="radio" name="delivery" value="2.99" class="hidden" checked>
                        <div>
                            <span class="text-sm font-medium">Standard</span><br>
                            <span class="text-xs text-gray-600">(3-5 business days) £2.99</span>
                        </div>
                    </label>
                    <!-- Express -->
                    <label
                        class="delivery-option flex flex-col justify-center bg-gray-100 hover:bg-gray-200 border rounded-lg px-4 py-3 cursor-pointer min-w-[140px]">
                        <input type="radio" name="delivery" value="4.99" class="hidden">
                        <div>
                            <span class="text-sm font-medium">Express</span><br>
                            <span class="text-xs text-gray-600">(1-3 business days) £4.99</span>
                        </div>
                    </label>
                    <!-- Collection (free) -->
                    <label
                        class="delivery-option flex flex-col justify-center bg-gray-100 hover:bg-gray-200 border rounded-lg px-4 py-3 cursor-pointer min-w-[140px]">
                        <input type="radio" name="delivery" value="0.00" class="hidden">
                        <div>
                            <span class="text-sm font-medium">Click & Collect</span><br>
                            <span class="text-xs text-gray-600">(0-1 business days) £0.00</span>
                        </div>
                    </label>
                    </div>
                    <hr class="my-4"><!-- seperation line solid-->
                    
                <div class="mb-4">
                    <div class="flex justify-between text-xs font-semibold">
                        <span id="free-shipping-text">£40.00 or more for free shipping!</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                        <div id="free-shipping-bar" class="h-2 bg-blue-600 rounded-full" style="width: 0%"></div>
                    </div>

                    <div class="text-sm space-y-1">
                        <div class="flex justify-between">
                            <span>Your SubTotal:</span>
                            <span id="subtotal">£0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Your Delivery:</span>
                            <span id="delivery">£0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Your Total:</span>
                            <span id="total">£0.00</span>
                        </div>

                        <!-- button for the checkout -->
                        <button
                            onclick="window.location.href='{{ route('checkout') }}'"
                            class="w-full mt-4 bg-red-600 hover:bg-red-700 text-white py-2.5 rounded font-semibold text-sm">
                            Proceed to checkout
                        </button>
                    </div>
                </div>
                <section class="mt-6 bg-white p-4 rounded-lg shadow-md text-sm">
                    <h2 class="text-xl font-semibold mb-2">Additional Information</h2>
                    <p>We at Bridge 14 Games are committed to ensuring that your needs are met and that your orders are
                        fullfilled,
                        our variation in ordering options range from 0-5 working days. Standard delivery which is £2.99
                        should arrive in the expect 3-5 business days,
                        express delivery is £4.99 ensuring a 1-3 business day delivery.
                        Last but not least click and collect is our free option to which if an item is in stock we can put
                        it through if not have it available to collect the following day.
                    </p>
                    <p class="mt-1 text-gray-500">We aim to proccess all orders within 24 of recieving the order although if
                        there are any issues feel free to contact us!</p>
                </section>
    </main>

    <!-- java script to categories the delivery options above -->
    <script>
        const FREE_SHIPPING_THRESHOLD = 40; //minimum for the free shipping
        function updateFreeShipping(subtotal) {
            const textEl = document.getElementById("free-shipping-text"); //text name from above
            const barEl = document.getElementById("free-shipping-bar");
            let percent = (subtotal / FREE_SHIPPING_THRESHOLD) * 100;
            if (percent > 100) percent = 100;
            if (percent <0) percent = 0;
            const remaining = FREE_SHIPPING_THRESHOLD - subtotal;
            if (remaining > 0) {
                textEl.textContent = "£" + remaining.toFixed(2) + " away from having free shipping!";
            } else {
                textEl.textContent = "Free shipping applied!";
            }
            barEl.style.width = percent.toFixed(2) + "%"; //add percentage to whats left or has on the bar
        }
        
        function updateTotals() {
            const radios = document.querySelectorAll("input[name='delivery']");
            const subtotalEl = document.getElementById("subtotal");
            const deliveryEl = document.getElementById("delivery");
            const totalEl = document.getElementById("total");
            const qtyInput = document.getElementById("quantity");
            const lineTotalEl = document.getElementById("line-total");
            let qty = parseInt(qtyInput.value);
            if(qty < 1) qty = 1; //makes sure its atleast 1 (otherwise 0 is removed)

            let selectedDelivery = 0;
            radios.forEach(radio => {
                if (radio.checked) {
                    selectedDelivery = parseFloat(radio.value);
                }
            });
            const price = 19.99; //EXAMPLE PRICE
            const subtotal = price * qty; //quantity times by the price for total
            let deliveryCost = selectedDelivery;
            if (subtotal >= FREE_SHIPPING_THRESHOLD) {
                deliveryCost = 0;
            } // gets free shipping for being 40 quid or more
            const total = subtotal + deliveryCost;
            lineTotalEl.textContent = "£" + subtotal.toFixed(2);
            subtotalEl.textContent = "£" + subtotal.toFixed(2);
            deliveryEl.textContent = "£" + deliveryCost.toFixed(2);
            totalEl.textContent = "£" + total.toFixed(2);
            updateFreeShipping(subtotal);
        }
    </script>
    <!-- https://www.convertcart.com/blog/cart-page-designs this is refences for the design ideas -->
    <script>
        function highlightDeliveryOption() { //highlights
            const options = document.querySelectorAll(".delivery-option");
            options.forEach(option => {
                const radio = option.querySelector("input[type='radio']");
                if (radio.checked) {
                    option.classList.add("ring-2", "ring-blue-500", "bg-blue-50", "border-blue-500");
                } else {
                    option.classList.remove("ring-2", "ring-blue-500", "bg-blue-50", "border-blue-500")
                }
            });
        }
        document.querySelectorAll("input[name='delivery']").forEach(radio => {
            radio.addEventListener("change", () => {
                highlightDeliveryOption();
                updateTotals(); //links the totals function too highlight funciton
            });
        });    
        document.getElementById("quantity").addEventListener("input", updateTotals); //auto update quantity
        highlightDeliveryOption(); //runs when the page loads each time
    </script>

@endsection