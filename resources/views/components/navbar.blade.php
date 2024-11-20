<nav class="bg-blue-600 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-white text-2xl font-bold">
            ShopMania
        </a>

        <!-- Navbar Links -->
        <div class="flex space-x-6">
            <a href="/" class="text-white hover:text-yellow-400">Home</a>
            <a href="{{ route('products') }}" class="text-white hover:text-yellow-400">Products</a>
            <a href="" class="text-white hover:text-yellow-400">About</a>
            <a href="" class="text-white hover:text-yellow-400">Contact</a>
        </div>

        <!-- Login Button -->
        <a href="" class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-md">
            Login
        </a>
    </div>
</nav>
