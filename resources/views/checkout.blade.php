@extends('layouts.app')
@section('content')
    <!--Tailwind Cheat Sheet: https://nerdcave.com/tailwind-cheat-sheet*-->
    <main class="max-w-6xl mx-auto px-4 py-12 flex-grow">
        <!-- inspo of this site https://www.convertcart.com/blog/checkout-page-examples-->
        <h1 class="text-3x1 font-bold-mb-8">Checkout</h1>
        <div class="md:grid md:grid-cols-3 gap-10">

            <!-- left side of the form with the payment form-->
            <div class="md:col-span-2 bg-white p-6 rounded-lg shadow">
                <!-- contact stuff and info -->
                <h2 class="text-xl font-semibold mb-4">Contact Information</h2>
                <form id ="checkoutForm" class="space-y-6">

                    <!-- Name form -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input id="fullName"
                                 type="text"
                                 required
                                 placeholder="John Pork"
                                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    
                    <!-- Email form -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Email Address</label>
                        <input id="email"
                                 type ="email"
                                 placeholder="example@gmail.com"
                                 required
                                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <hr class = "my-6"> <!--faint line below-->

                    <!--Card details-->
                    <div>
                        <label class="block text-sm font-medium mb-1">Card Details</label>
                        <input id="cardNumber"
                                 type="text"
                                 required
                                 inputmode="numeric"
                                 placeholder="1234 5678 9012 3456"
                                 class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Expiration of card -->
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm font-medium mb-1">Expiration Date</label>
                            <input id="expiry"
                                    type="text"
                                    maxlength="5"
                                    placeholder="MM/YY"
                                    required
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    <!--CVV data-->
                    <div class="w-28">
                        <label class="block text-sm font-medium mb-1">CVV</label>
                        <input id= "cvv"
                                type="text"
                                maxlength="3"
                                pattern="[0-9]{3}"
                                placeholder="123"
                                required
                                inputmode="numeric"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
                    </div> 

            </div>
            <!-- name onm the card-->
            <div>
                <label class="block text-sm font-medium mb-1">Name on Card</label>
                <input id="cardName"
                        type="text"
                        required
                        placeholder="Exactly as on your card!"
                        class= "w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- error message for wrong input -->
             <p id="errorBox" class="text-red-600 text-sm font-medium hidden"></p>
            <!--Button-->
            <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white px-2 rouded-lg font-semibold">
                Place order
            </button>

        </form>
    </div>

    <!-- right side for summary of product(s)-->
    <div class ="md:grid md:cols-span-1">
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100 h-fit">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>
        
        <div class="flex items-center gap-4 mb-4">
            <img src ="/images/products/d&d.png"
                class="w-20 h-20 rounded object-contain bg-gray-100" alt="D&D Dragons of Stormwreck Isle">
            <div class="flex-1">
                <p class="font-semibold">D&D Dragons of Stormwreck Isle</p>
                <p class="text-sm text-gray-500">Qauntity: 1</p>
            </div>
            <p class="font-semibold text-sm">£19.99</p>
        </div>
        <hr class= "my-4">

        <div class="text-sm space-y-2">
            <div class="flex justify-between">
                <span>Subtotal:</span>
                <span>£19.99</span>
            </div>
            <div class="flex justify-between">
                <span>Delivery:</span>
                <span>£0.00</span>
            </div>
            <div class="flex justify-between font-semibold text-lg pt-2">
                <span>Total:</span>
                <span>£19.99</span>
            </div>
        </div>
    </div>

</div>

</main>

<!-- scripts for the validation rules etc.-->
 <script>
document.getElementById("checkoutForm").addEventListener("submit", function(e) {
    e.preventDefault();
    const expiry = document.getElementById("expiry").value;
    const name = document.getElementById("fullName").value.trim();
    const cardName= document.getElementById("cardName").value.trim();
    const cardNumber = document.getElementById("cardNumber").value;
    const cvv =document.getElementById("cvv").value;
    const errorBox =document.getElementById("errorBox");

//ALL CARD VALIDATIONS:
    if (name.toLowerCase() !== cardName.toLowerCase()) {
        errorBox.textContent= "The name on the card must be the same as the one entered above!";
        errorBox.classList.remove("hidden");
        return;
    }
    const rawCardNumber = document.getElementById("cardNumber").value.replace(/\s/g, "");
    if (!/^[0-9]{16}$/.test(rawCardNumber)) {
        errorBox.textContent = "Card number must consist of 16 digits!"
        errorBox.classList.remove("hidden");
        return;
    }

    //expiry checking
    if(!/^\d{2}\/\d{2}$/.test(expiry)) {
        errorBox.textContent = "USE MM/YY FORMAT!" 
        errorBox.classList.remove("hidden");
        return;
    }
    const [month, year] = expiry.split("/").map(x => parseInt(x, 10));
    if (month < 1 || month > 12) { 
        errorBox.textContent ="Month must be between 01 and 12";
        errorBox.classList.remove("hidden");
        return;
    }
    const today = new Date();
    const expiryDate = new Date(2000 + year, month -1);
    if(expiryDate <= today) {
        errorBox.textContent = "Card is expired!"
        errorBox.classList.remove("hidden");
        return;
    }

//Otehr form validations
    errorBox.classList.add("hidden");
    window.location.href = "/order/complete";
});

//https://syntaxsimplified.com/cheatsheet/Javascript/javascript.html some help from this site too
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const cardInput = document.getElementById("cardNumber");
    if(!cardInput) return;
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
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const expInput =document.getElementById("expiry");
        if (!expInput) return;
        expInput.addEventListener("input", function () {
            let v= expInput.value.replace(/\D/g, ""); //makes sure that numbers only
            v= v.slice(0, 4);

            if(v.length >= 3) {
                expInput.value= v.slice(0, 2) + "/" + v.slice(2); // puts the slash inbetween
            } else {
                expInput.value =v;
            }
        });
    });
</script>

@endsection