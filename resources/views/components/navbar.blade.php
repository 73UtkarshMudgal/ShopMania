<nav class="bg-gray-800 text-white py-4">
    <div class="container mx-auto flex items-center justify-between">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold">ShopMania</a>

        <!-- Search Bar -->
        <div class="hidden lg:flex flex-1 justify-center mx-6">
            <form action="" method="GET" class="flex">
                <input 
                    type="text" 
                    name="query" 
                    placeholder="Search for Products" 
                    class="w-96 p-2 rounded-l-md text-black focus:outline-none focus:ring focus:ring-yellow-400"
                />
                <button 
                    type="submit" 
                    class="bg-yellow-500 px-4 py-2 rounded-r-md hover:bg-yellow-600">
                    Search
                </button>
            </form>
        </div>

        <!-- Right Section: Links and Cart -->
        <div class="flex items-center space-x-6">
            <!-- Links -->
            <a href="/" class="hover:text-yellow-400 hidden lg:block">Home</a>
            <a href="{{ route('products') }}" class="hover:text-yellow-400 hidden lg:block">Products</a>
            <a href="#" class="hover:text-yellow-400 hidden lg:block">Contact</a>

            <!-- Cart -->
            <a href="{{ route('cart') }}" class="relative">
                <i class="fas fa-shopping-cart text-2xl"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-xs text-white rounded-full px-2">0</span>
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="lg:hidden text-2xl">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-gray-800 mt-4 space-y-2 p-4">
        <a href="/" class="block text-white hover:text-yellow-400">Home</a>
        <a href="{{ route('products') }}" class="block text-white hover:text-yellow-400">Products</a>
        <a href="#" class="block text-white hover:text-yellow-400">Contact</a>
    </div>
</nav>

<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>
