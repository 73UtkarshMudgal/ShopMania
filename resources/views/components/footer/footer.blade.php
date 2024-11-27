<!-- resources/views/components/footer/footer.blade.php -->

<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-6 md:px-12">
        <!-- Footer Content Wrapper: Flexbox to center everything -->
        <div class="flex flex-col items-center space-y-6">

            <!-- Left Section: Company Info and Links (Center aligned on all screens) -->
            <div class="text-center">
                <h3 class="text-2xl font-semibold text-white sm:text-xl">ShopMania</h3>
                <p class="text-gray-400 mt-2 mb-4 text-sm sm:text-base">Your one-stop online shop for the latest products at great prices.</p>
                <div class="flex justify-center space-x-6">
                    <a href="/about" class="hover:text-gray-400 text-sm sm:text-base">About</a>
                    <a href="/contact" class="hover:text-gray-400 text-sm sm:text-base">Contact</a>
                </div>
            </div>

            <!-- Right Section: Social Media Icons (Center aligned on all screens) -->
            <div class="flex justify-center space-x-6 mt-4">
                <a href="https://github.com/73UtkarshMudgal" class="text-gray-400 hover:text-white text-2xl sm:text-xl" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://www.linkedin.com/in/utkarsh-mudgal" class="text-gray-400 hover:text-white text-2xl sm:text-xl" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <!-- Bottom Section: Copyright (Always centered) -->
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} ShopMania. All Rights Reserved.</p>
        </div>
    </div>
</footer>
