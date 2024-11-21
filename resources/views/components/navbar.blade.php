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

        <!-- Right side of Navbar (Login/Register/Cart) -->
        <div class="flex items-center space-x-6 ml-auto"> <!-- `ml-auto` pushes this part to the right -->
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-transparent hover:bg-yellow-500 focus:bg-yellow-500 active:bg-yellow-500 focus:outline-none active:text-white transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <!-- Logout Button -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @else
                <div class="flex space-x-6">
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="text-gray-500 font-medium bg-white hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">
                        Login
                    </a>

                    <!-- Register Button -->
                    <a href="{{ route('register') }}" class="text-gray-500 font-medium bg-white hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">
                        Register
                    </a>
                </div>
            @endauth

            <!-- Cart Icon (Extreme right of the navbar) -->
            <a href="{{ route('cart') }}" class="text-white hover:text-yellow-400 px-3 py-2">
                <i class="fas fa-shopping-cart text-2xl"></i>
            </a>
        </div>
    </div>
</nav>
