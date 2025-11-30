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
      <a href="{{ url('/') }}">Bridge 14 Games</a>
    </div>
    <nav class="space-x-4 text-white font-semibold">
      <a href="{{ url('/product_details.blade.php') }}" class="hover:underline">Shop</a>
      <a href="#" class="hover:underline">Cart</a>
      <a href="signup.blade.php" class="hover:underline">Sign up / Sign in</a>
    </nav>
  </header>


  <main class="flex-grow">
  </main>


  <footer class="bg-gray-900 text-gray-300 p-6 mt-auto">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0">
      <div>&copy; 2025 Bridge 14 Games</div>
    </div>
  </footer>

</body>
</html>