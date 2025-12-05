<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bridge 14 Games</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-black variable-text">
    <div id="star-layer"></div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <img src={{ asset('images/logo-text-dark.webp') }} alt="Logo" class="h-[14rem] w-auto" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-lg hover:shadow-gray-600 transition duration-200 overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
