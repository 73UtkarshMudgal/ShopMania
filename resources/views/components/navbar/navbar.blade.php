<!-- resources/views/components/navbar/navbar.blade.php -->
<nav class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
        <!-- Logo Component -->
        <x-navbar.logo />

        <!-- Hamburger Menu (Visible on small screens) -->
        <div class="md:hidden flex items-center">
            <button id="menu-toggle" class="text-white hover:text-gray-300">
                <i class="fas fa-bars"></i> <!-- Hamburger Icon -->
            </button>
        </div>

        <!-- Links Component -->
        <div id="menu" class="hidden md:flex space-x-4">
            <x-navbar.links />
        </div>

        <!-- User Info (If logged in) -->
        @auth
            <div class="flex items-center space-x-4">
                <!-- User Name (Display when logged in) -->
                <span class="text-white">Hello, {{ Auth::user()->name }}</span>

                <!-- Logout button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                </form>
            </div>
        @endauth

        <!-- Cart Component (If logged in) -->
        @auth
            <x-navbar.cart />
        @endauth

        <!-- Authentication Links (Visible for guests) -->
        @guest
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a>
            </div>
        @endguest
    </div>
</nav>

<script>
    // Toggle the visibility of the menu on small screens
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
</script>
