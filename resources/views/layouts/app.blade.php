<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'ShopMania') }}</title>

    <!-- Font Awesome for icons (like cart) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Vite Asset Handling (for CSS) -->
    @vite('resources/css/app.css')

    <!-- Optional: If you want to add Bootstrap CSS directly through CDN -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>

<body class="bg-gray-50">

    <!-- Include Navigation (since it's located in layouts/navigation.blade.php) -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="min-h-screen">
        @yield('content') <!-- This will be replaced with page-specific content -->
    </div>

    <!-- Footer (Optional: Add a footer component if needed) -->
    <x-footer /> <!-- Assuming you have a footer component -->

    <!-- Vite Asset Handling (for JS) -->
    @vite('resources/js/app.js')

    <!-- Optional: If you want to add Bootstrap JS directly through CDN -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>
