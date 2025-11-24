<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Bridge 14 Games</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

  <header class="bg-blue-600 p-4 flex justify-between items-center">
    <div class="text-white font-bold text-2xl">
      <a href="{{ url('/') }}">Bridge 14 Games</a></div>
    <nav class="space-x-4 text-white font-semibold">
      <a href="{{ url('/product_details.blade.php') }}" class="hover:underline">Shop</a>
      <a href="#" class="hover:underline">Cart</a>
      <a href="#" class="hover:underline">Sign up / Sign in</a>
    </nav>
  </header>

<section class="bg-cover bg-center h-96 flex items-center justify-center text-center text-black px-4" style="background-image: url('/images/tabletop.jpg')">
    <div>
      <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">Discover Your New Gaming Obsession</h1>
      
      <p class="mb-6 text-lg md:text-xl drop-shadow-lg">The first stop shop for all your tabletop and video gaming needs</p>
      <div class="flex justify-center space-x-4">
        <a href="#" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-lg transition">Shop Now</a>
      </div>
    </div>
</section>

  <section class="max-w-7xl mx-auto px-4 py-12">
    <h2 class="text-3xl font-bold text-center mb-8">Featured Products</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
        <img src="#" alt="product 1" class="h-48 w-full object-cover mb-4 rounded"/>
        <h3 class="text-xl font-semibold mb-2"> product 1</h3>
        <p class="text-red-500 mb-4 text-lg">£49.99</p>
        <a href="{{ url('/product1-details') }}" class="mt-auto bg-gray-800 text-white text-center py-2 px-4 rounded hover:bg-gray-700 font-semibold transition">View Product</a>      </div>
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
        <img src="#" alt="product 2" class="h-48 w-full object-cover mb-4 rounded"/>
        <h3 class="text-xl font-semibold mb-2">product 2</h3>
        <p class="text-red-500 mb-4 text-lg">£59.99</p>
        <a href="#" class="mt-auto bg-gray-800 text-white text-center py-2 px-4 rounded hover:bg-gray-700 font-semibold transition">Under Construction...</a>
      </div>
      <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
        <img src="#" alt="product 3" class="h-48 w-full object-cover mb-4 rounded"/>
        <h3 class="text-xl font-semibold mb-2">product 3</h3>
        <p class="text-red-500 mb-4 text-lg">£39.99</p>
        <a href="#" class="mt-auto bg-gray-800 text-white text-center py-2 px-4 rounded hover:bg-gray-700 font-semibold transition">Under Construction...</a>
      </div>
    </div>
  </section>

  <section class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h2 class="text-3xl font-bold mb-8">Categories</h2>
      <div class="flex flex-wrap justify-center gap-4">
        <div class="bg-blue-500 text-white p-4 rounded-lg cursor-pointer hover:bg-blue-600 transition">Tabletop Games</div>
        <div class="bg-green-500 text-white p-4 rounded-lg cursor-pointer hover:bg-green-600 transition">Video Games</div>
        <div class="bg-purple-500 text-white p-4 rounded-lg cursor-pointer hover:bg-purple-600 transition">Video Gaming accessories</div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg cursor-pointer hover:bg-yellow-600 transition">Tabletop Gaming accessories</div>
        <div class="bg-red-500 text-white p-4 rounded-lg cursor-pointer hover:bg-yellow-600 transition">Consoles</div>

      </div>
    </div>
  </section>

  <section class="max-w-7xl mx-auto px-4 py-12 text-center">
    <h2 class="text-3xl font-bold mb-8">Why Choose Bridge 14 Games?</h2>
    <div class="flex flex-wrap justify-center gap-6">
      <div class="bg-gray-100 p-6 rounded-lg w-full md:w-1/3 shadow hover:shadow-xl transition">
        <h3 class="text-xl font-semibold mb-2">Wide Selection</h3>
        <p>Explore our vast collection of tabletop and gaming paraphernalia. From tabletop games to video games and consoles, we're sure that we have something you'll love</p>
      </div>
      <div class="bg-gray-100 p-6 rounded-lg w-full md:w-1/3 shadow hover:shadow-xl transition">
        <h3 class="text-xl font-semibold mb-2">Expert Recommendations</h3>
        <p>Our team will help you find the perfect game for you based on your needs</p>
      </div>
      <div class="bg-gray-100 p-6 rounded-lg w-full md:w-1/3 shadow hover:shadow-xl transition">
        <h3 class="text-xl font-semibold mb-2">fast Shipping</h3>
        <p>Quick and reliable dispatch on all orders, with free shipping over £40</p>
      </div>
    </div>
  </section>

  <section class="bg-gray-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h2 class="text-3xl mb-4">Join the Bridge 14 Community</h2>
      <p class="mb-6">Subscribe to our newsletter and receive updates on new releases and exclusive deals</p>
      <form class="flex max-w-md mx-auto space-x-2">
        <input type="email" placeholder="Enter your email" class="bg-gray-800 w-full p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        <button class="bg-blue-500 hover:bg-blue-600 px-4 py-3 rounded-lg font-semibold transition">Subscribe</button>
      </form>
    </div>
  </section>

  <footer class="bg-gray-900 text-gray-300 p-6 mt-auto">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0">
      <div>&copy; 2025 Bridge 14 Games</div>
    </div>
  </footer>
</body>
</html>