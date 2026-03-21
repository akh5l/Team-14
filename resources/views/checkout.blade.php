@extends('layouts.app')
@section('content')
    <!--Tailwind Cheat Sheet: https://nerdcave.com/tailwind-cheat-sheet*-->
    <main class="max-w-6xl mx-auto px-4 py-12 flex-grow">
        
        <!-- inspo of this site https://www.convertcart.com/blog/checkout-page-examples-->
        <h1 class="text-3xl font-bold mb-8 text-center">Checkout</h1>
        <div class="md:grid md:grid-cols-3 gap-10">

            <!-- left side of the form with the payment form-->
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow">
                <!-- contact stuff and info -->
                <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                <form id="checkoutForm" method="POST" action="{{ route('orders.store') }}" class="space-y-6">
                    @csrf

                    <!-- Name form -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input id="fullName" type="text" required placeholder="Name"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Email form -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Email Address</label>
                        <input id="email" type ="email" placeholder="example@gmail.com" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <hr class = "my-6"> <!--faint line below-->

                    {{-- Shipping Address --}}
                    {{-- Address line 1 --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Address Line 1</label>
                        <input id="address_line1" name="address_line1" type="text" required placeholder="Required"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    {{-- Address line 2 --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Address Line 2</label>
                        <input id="address_line2" name="address_line2" type ="text"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    {{-- City --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">City</label>
                        <input id="city" name="city" type="text" required placeholder="Required"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    {{-- Postcode --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Postcode</label>
                        <input id="postcode" name="postcode" type ="text" placeholder="Required" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <hr class = "my-6"> <!--faint line below-->

                    <!--Card details-->
                    <div>
                        <label class="block text-sm font-medium mb-1">Card Details</label>
                        <input id="cardNumber" type="text" required inputmode="numeric" placeholder="**** **** **** ****"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Expiration of card -->
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-1">Expiration Date</label>
                            <input id="expiry" type="text" maxlength="5" placeholder="MM/YY" required
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <!--CVV data-->
                        <div class="w-28">
                            <label class="block text-sm font-medium mb-1">CVV</label>
                            <input id= "cvv" type="text" maxlength="3" pattern="[0-9]{3}" placeholder="***"
                                required inputmode="numeric"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                    </div>
                    <!-- name on the card-->
                    <div>
                        <label class="block text-sm font-medium mb-1">Name on Card</label>
                        <input id="cardName" type="text" required placeholder="Exactly as on your card!"
                            class= "w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!--Button-->
                    <button type="submit"
                        class="w-full h-8 bg-blue-600 hover:bg-blue-700 text-white px-2 rounded-lg font-semibold hover:scale-105 hover:shadow-lg active:scale-100 transition transform duration-200">
                        Place order
                    </button>

                </form>
            </div>

            <!-- right side for summary of product(s)-->
            <div class ="md:grid md:cols-span-1">
                <div class="bg-white p-6 rounded-lg shadow border border-gray-100 h-fit">
                    <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

                    @foreach ($items as $item)
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ $item['image_url'] }}" class="w-20 h-20 rounded object-contain bg-gray-100"
                                alt="{{ $item['product_name'] }}">
                            <div class="flex-1">
                                <p class="font-semibold">{{ $item['product_name'] }}</p>
                                <p class="text-sm text-gray-500">Quantity: {{ $item['quantity'] }}</p>
                            </div>
                            <p class="font-semibold text-sm">
                                £{{ number_format($item['price'] * $item['quantity'], 2) }}
                            </p>
                        </div>
                    @endforeach

                    <div class="text-sm space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span id="checkout-subtotal">£{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Delivery:</span>
                            <span id="checkout-delivery">£0.00</span>
                        </div>
                        <div class="flex justify-between font-semibold text-lg pt-2">
                            <span>Total:</span>
                            <span id="checkout-total">£{{ number_format($subtotal, 2) }}</span>
                        </div>
                    </div>
                </div>

            </div>

    </main>

    <!-- making the modals (popups) using this as reference and help:
                     https://flowbite.com/docs/components/modal/#content -->

    {{-- success modal has been moved to history.blade.php -akhil --}}

    <div id="errorModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class ="bg-white rounded-lg shadow-lg p-6 w-full max-w-md text-center modal-show">
            <h2 class="text-xl font-semibold text-red-600 mb-4">Error!</h2>
            <p id= "errorModalMessage" class= "text-sm text-gray-700 mb-6"></p>
            <button id="errorModalClose"
                class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg font-semibold">
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

        // error modals for all validations
        document.addEventListener("DOMContentLoaded", function() {
            const errorModal = document.getElementById("errorModal");
            const errorModalMsg = document.getElementById("errorModalMessage");
            const errorModalClose = document.getElementById("errorModalClose");
            window.showErrorModal = function(msg) {
                errorModalMsg.textContent = msg;
                errorModal.classList.remove("hidden");
            };
            errorModalClose.addEventListener("click", function() {
                errorModal.classList.add("hidden");
            });
        });

        // scripts for validation

        document.getElementById("checkoutForm").addEventListener("submit", function(e) {
            const expiry = document.getElementById("expiry").value;
            const name = document.getElementById("fullName").value.trim();
            const cardName = document.getElementById("cardName").value.trim();
            const cardNumber = document.getElementById("cardNumber").value;
            const cvv = document.getElementById("cvv").value;

            let isValid = true;

            // ALL CARD VALIDATIONS:
            if (name.toLowerCase() !== cardName.toLowerCase()) {
                showErrorModal("The name on the card must be the same as the one entered above!");
                isValid = false;
            }
            const rawCardNumber = document.getElementById("cardNumber").value.replace(/\s/g, "");
            if (!/^[0-9]{16}$/.test(rawCardNumber)) {
                showErrorModal("Card number must consist of 16 digits!");
                isValid = false;
            }

            //expiry checking
            if (!/^\d{2}\/\d{2}$/.test(expiry)) {
                showErrorModal("USE MM/YY FORMAT!");
                isValid = false;
            }
            const [month, year] = expiry.split("/").map(x => parseInt(x, 10));
            if (month < 1 || month > 12) {
                showErrorModal("Month must be between 01 and 12");
                isValid = false;
            }
            const today = new Date();
            const expiryDate = new Date(2000 + year, month - 1);
            if (expiryDate <= today) {
                showErrorModal("Card is expired!");
                isValid = false;
            }

            if (!isValid) {
              e.preventDefault();
              return;
            }
        });

        //https://syntaxsimplified.com/cheatsheet/Javascript/javascript.html some help from this site too

        // card input styling and formatting

        document.addEventListener("DOMContentLoaded", function() {
            const cardInput = document.getElementById("cardNumber");
            if (!cardInput) return;
            cardInput.addEventListener("input", function() {
                let value = cardInput.value.replace(/\D/g, "");
                value = value.slice(0, 16);
                let formatted = "";
                for (let i = 0; i < value.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formatted += " ";
                    }
                    formatted += value[i]
                }
                cardInput.value = formatted;
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const expInput = document.getElementById("expiry");
            if (!expInput) return;
            expInput.addEventListener("input", function() {
                let v = expInput.value.replace(/\D/g, ""); // ensure numerical input only
                v = v.slice(0, 4);

                if (v.length >= 3) {
                    expInput.value = v.slice(0, 2) + "/" + v.slice(2); // puts forward slash in expiry date
                } else {
                    expInput.value = v;
                }
            });
        });
    </script>
@endsection
