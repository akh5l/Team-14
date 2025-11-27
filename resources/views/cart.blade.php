<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Bridge 14 Games - Cart</title>
  @vite('resources/css/app.css')
</head>
<!--Tailwind Cheat Sheet: https://nerdcave.com/tailwind-cheat-sheet*-->
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">
    <header class="bg-blue-600 p-4 flex justify-between items-center">
    <div class="text-white font-bold text-2xl">
      <a href="{{ url('/') }}">Bridge 14 Games - Cart</a></div>
    <nav class="space-x-4 text-white font-semibold">
      <a href="{{ url('/home') }}" class="hover:underline">Home</a>
      <a href="{{ url('/product_details') }}" class="hover:underline">Shop</a>
      <a href="#" class="hover:underline">Sign up / Sign in</a>
    </nav>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-8 flex-grow">
      <h1 class = "text-3xl font-bold mb-6">Your Shopping Cart</h1>
      <div class="md:grid md:grid-cols-3 gap-6 items-start">
        
      <!-- added cart items will go here (on the left side of page)--> 
        <div class="bg-white rounded-lg shadow p-4 md:p-6">

          <!--example for now tho -->
          <div class="md:col-span2 space-y-4">
            <div class="flex gap-3 items-center justify-between">
              <img src="/images/tabletop.jpg" alt ="Product Image" class="w-32 h-32 object-cover rounded"/>
              
              <div class="flex-1">
                <p class="font-semibold text-lg">Product Name "1"</p>
                <p class="text-gray-500 text-sm">Product Number: "#12345"</p>
                </div class="mt-3 flex items-center gap-3">
                  <span class="text-sm">Quantity:</span>
                  <!-- allows input of the quatity of item -->
                  <input
                    type="integer"
                    min="1"
                    value="1"
                    class="w-16 border border-gray-300 rounded px-2 py-1 text-center text-sm">
                  <button class="text-xs text-blue-600 hover:underline mt-1">Update</button>
                </div>
              </div>


              <div class="text-right">
                <p class="font-semibold">£17.38</p>
                <button class="text-xs text-red-500 hover:underline mt-1">Remove</button>
              </div>
            </div>
          </div>

    <!-- Summary of cart section here (right side) -->
    <div class="mt-6 md:mt-0"> 
      <div class="bg-white p-6 rounded-lg shadow-md">
        
        <!-- https://flowbite.com/docs/forms/radio/ radio types following horizontal example-->
        <p class="font-semibold mb-3">Choice of Delivery</p>
        
        <div class="flex flex-col md:flex-row gap-3">
          <!-- Standard -->
          <label class="flex items-center gap-3 bg-gray-200 hover:bg-gray-50 border rounded-1g px-4 py-3 cursor-pointer w-full md:w-auto">
            <input type="radio" name="delivery" value="2.99" class="hidden" checked>
            <div>
              <span class="text-sm font-medium">Standard</span><br>
              <span class="text-xs text-gray-600">(3-5 business days) £2.99</span>
            </div>
          </label>
          <!-- Express -->
          <label class="flex items-center gap-3 bg-gray-200 hover:bg-gray-50 border rounded-1g px-4 py-3 cursor-pointer w-full md:w-auto">
            <input type="radio" name="delivery" value="4.99" class="hidden" checked>
            <div>
              <span class="text-sm font-medium">Express</span><br>
              <span class="text-xs text-gray-600">(1-3 business days) £4.99</span>
            </div>
          </label>
          <!-- Collection (free) -->
          <label class="flex items-center gap-3 bg-gray-200 hover:bg-gray-50 border rounded-1g px-4 py-3 cursor-pointer w-full md:w-auto">
            <input type="radio" name="delivery" value="0.00" class="hidden" checked>
            <div>
              <span class="text-sm font-medium">Click & Collect</span><br>
              <span class="text-xs text-gray-600">(0-1 business days) £0.00</span>
            </div>
          </label>

        <hr class="my-4">
        
        <!-- seperation line solid-->
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
      <button class="w-full mt-4 bg-red-600 hover:bg-red-700 text-white py-2.5 rounded font-semibold text-sm">
        Proceed to checkout
      </button>
    </div>
</div>
    <section class="mt-6 bg-white p-4 rounded-lg shadow-md text-sm">
      <h2 class="font-semibold mb-2">Additional Information</h2>
      <p>We at Bridge 14 Games are committed to ensuring that your needs are met and that your orders are fullfilled, 
        our variation in ordering options range from 0-5 working days. Standard delivery which is £2.99 should arrive in the expect 3-5 business days, 
        express delivery is £4.99 ensuring a 1-3 business day delivery. 
        Last but not least click and collect is our free option to which if an item is in stock we can put it through if not have it available to collect the following day.
      </p>
      <p class="mt-1 text-gray-500">We aim to proccess all orders within 24 of recieving the order although if there are any issues feel free to contact us!</p>
    </section>
  </main>
  <footer class="bg-blue-600 text-white p-6 mt-auto">
    <div class="max-w-7xl mx-auto text-center">
      &copy; 2025 Bridge 14 Games <!-- trademark like -->
    </div>
  </footer>

   <!-- java script to categories the delivery options above -->
  <script>
    function updateTotals() {
      const radios = document.querySelectorAll("input[name='delivery']");
      const subtotalEl = document.getElementById("subtotal");
      const deliveryEl = document.getElementById("delivery");
      const totalEl = document.getElementById("total");
      let selectedDelivery =0;
      radios.forEach(radio => {
        if (radio.checked) {
          selectedDelivery = parseFloat(radio.value);
        }
      });
      let subtotal = 17.38; //example for now
      let total = subtotal + selectedDelivery;
      subtotalEl.textContent = "£" + subtotal.toFixed(2);
      deliveryEl.textContent = "£" + selectedDelivery.toFixed(2);
      totalEl.textContent = "£" + total.toFixed(2);
    }
    updateTotals(); //runs as soon as page loads basically
    document.querySelectorAll("input[name='delivery']").forEach(radio => {
      radio.addEventListener("change", updateTotals); //runs again when delivery option chnages
    });
    </script>

    <script>
      function highlighDeliveryOption() { //highlights
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
            highlighDeliveryOption();
            updateTotals(); //links the totals function too highlight funciton
          });
        });
        highlightDeliveryOption(); //runs when the page loads each time
      </script>

</body>
</html>