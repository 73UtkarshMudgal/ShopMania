<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopMania</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Vite Asset Handling (for CSS) -->
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-50">
<!-- Navbar Component -->
<x-navbar />

    <!-- Main Content -->
    <div class="min-h-screen">
        @yield('content') <!-- This will be replaced with the products content -->
    </div>

    <!-- Vite Asset Handling (for JS) -->
    @vite('resources/js/app.js')

</body>

</html>
