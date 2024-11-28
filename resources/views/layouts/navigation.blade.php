<!-- Nav 1: Desktop View -->
<nav class="bg-black text-white shadow-md">
    <div class="w-full px-0 pt-4 @if(Auth::check() && Auth::user()->is_admin) pb-4 @else pb-0 @endif">
        <!-- Row 1: Logo, Profile, and Cart (Desktop and Mobile) -->
        <div class="flex justify-between items-center space-x-4 bg-black px-4">
            <!-- Logo (Conditionally disable for admin users) -->
            <x-navbar.logo />

            <!-- Row 2: Search Bar for Medium and Larger Screens -->
            @if(!Auth::check() || !Auth::user()->is_admin) <!-- Only show search bar if not admin -->
                <div class="hidden md:flex items-center space-x-4 ml-auto w-full">
                    <!-- Search Bar (Visible on Medium and Larger Screens) -->
                    <div class="flex w-full">
                    <form action="{{ route('products.search') }}" method="GET" class="flex w-full">
                        <input 
                            type="text" 
                            name="query" 
                            class="px-4 py-2 rounded-l-md text-black w-full" 
                            placeholder="Search for Products" 
                            value="{{ request()->query('query') }}">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-500 px-6 py-2 rounded-r-md text-white">
                            SEARCH
                        </button>
                    </form>
                    </div>
                </div>
            @endif

            <!-- User Info or Login/Register Dropdown -->
            <div class="relative">
                @auth
                    <!-- Always show Log Out button -->
                    @if(!Auth::user()->is_admin)
                        <!-- Authenticated User Dropdown -->
                        <button id="userDropdownButton" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                <div class="ml-1">
                                    <svg id="dropdownArrow" class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </button>

                        <!-- Dropdown Content for Authenticated User -->
                        <div id="userDropdown" class="absolute right-0 hidden mt-2 w-48 bg-gray-800 text-white rounded-md shadow-lg z-10">
                            <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-white hover:bg-gray-800 rounded-md">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-white hover:bg-gray-800 rounded-md">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    @else
                        <!-- Always show Log Out button for Admins -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-white hover:bg-gray-800 rounded-md">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    @endif
                @else
                    <!-- Unauthenticated User Dropdown (Login & Register) -->
                    <button id="guestDropdownButton" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white bg-gray-800 hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div class="flex items-center">
                            <i class="fas fa-user-circle text-xl"></i> <!-- Font Awesome user icon -->
                            <div class="ml-1">
                                <svg id="dropdownArrowGuest" class="fill-current h-4 w-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </button>

                    <!-- Dropdown Content for Guest User (Login & Register) -->
                    <div id="guestDropdown" class="absolute right-0 hidden mt-2 w-48 bg-gray-700 text-white rounded-md shadow-lg z-10">
                        <x-dropdown-link :href="route('login')" class="block px-4 py-2 text-white hover:bg-gray-600 rounded-md">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('register')" class="block px-4 py-2 text-white hover:bg-gray-600 rounded-md">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    </div>
                @endauth
            </div>

            <!-- Cart (Conditionally hide for admin users) -->
            @if(!Auth::check() || !Auth::user()->is_admin)
         

<!-- Cart -->
<x-navbar.cart />
@endif
</div>
@if(!Auth::check() || !Auth::user()->is_admin)
<div class="md:hidden w-full mt-4 px-4">
<div class="flex">
<input type="text" class="px-25 py-2 rounded-l-md text-black w-full" placeholder="Search for Products">
<button class="bg-purple-600 hover:bg-purple-500 px-4 py-2 rounded-r-md text-white">
SEARCH
</button>
</div>
</div>
<!-- Row 3: Desktop Navigation Links (Home, About, Products, Contact) -->
<div class="hidden sm:flex mt-4 justify-center bg-gray-700 p-[10px] w-full">
<!-- Include links.blade.php here -->
<x-navbar.links />
</div>
@endif
</div>
</nav>

@if(!Auth::check() || !Auth::user()->is_admin) 
<div class="flex sm:hidden bg-black py-2"></div>
<!-- Row 4: Mobile View (Hamburger Menu) -->
<nav class="bg-gray-700 text-white shadow-md sm:hidden ">
    <div class="w-full px-4 py-1">
        <!-- Row 1: Hamburger Button and Menu Title -->
        <div class="flex items-center justify-between">
            <!-- Hamburger Button -->
            <button id="hamburgerMenuButton" class="flex items-center text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Centered Menu Text -->
            <div class="flex-grow text-center">
                <span class="text-lg font-semibold">Menu</span>
            </div>
        </div>

        <!-- Row 2: Hidden Links for Mobile (Hamburger Menu Links) -->
        <div id="mobileMenu" class="hidden mt-2 bg-gray-700 p-4 rounded-md">
            <x-navbar.links />
        </div>
    </div>
</nav>
@endif



<script>
    // Toggle dropdown arrow rotation and dropdown visibility for authenticated user
    const userDropdownButton = document.getElementById("userDropdownButton");
    const dropdownArrow = document.getElementById("dropdownArrow");
    const userDropdown = document.getElementById("userDropdown");

    userDropdownButton?.addEventListener("click", function (event) {
        event.stopPropagation();
        userDropdown.classList.toggle("hidden");
        dropdownArrow.classList.toggle("rotate-180");
    });

    document.addEventListener("click", function (event) {
        if (!userDropdownButton.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.add("hidden");
            dropdownArrow.classList.remove("rotate-180");
        }
    });

    const guestDropdownButton = document.getElementById("guestDropdownButton");
    const dropdownArrowGuest = document.getElementById("dropdownArrowGuest");
    const guestDropdown = document.getElementById("guestDropdown");

    guestDropdownButton?.addEventListener("click", function (event) {
        event.stopPropagation();
        guestDropdown.classList.toggle("hidden");
        dropdownArrowGuest.classList.toggle("rotate-180");
    });

    document.addEventListener("click", function (event) {
        if (!guestDropdownButton.contains(event.target) && !guestDropdown.contains(event.target)) {
            guestDropdown.classList.add("hidden");
            dropdownArrowGuest.classList.remove("rotate-180");
        }
    });

    // Toggle mobile menu visibility
    const hamburgerMenuButton = document.getElementById("hamburgerMenuButton");
    const mobileMenu = document.getElementById("mobileMenu");

    hamburgerMenuButton?.addEventListener("click", function () {
        mobileMenu.classList.toggle("hidden");
    });
</script>
