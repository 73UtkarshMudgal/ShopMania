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

        @auth
        <!-- Logout Button -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <div class="flex space-x-6">
            <button type="submit" class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-md">
                Logout
            </button>
        </div>
        </form>
         
        @else

        <div class="flex space-x-6">
        <!-- Login Button -->
        <a href="{{ route('login') }}" class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-md">
            Login
        </a>
        <!-- Register Button -->
        <a href="{{ route('register') }}" class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-md">
            Register
        </a>
        </div>
        @endauth
    </div>
</nav>
