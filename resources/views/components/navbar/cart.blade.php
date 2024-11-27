<div class="relative">
    <a href="{{ route('cart') }}" class="text-white hover:text-gray-300">
        <!-- Cart Icon: Increased size -->
        <i class="fas fa-shopping-cart text-white text-2xl"></i> <!-- Increased size here -->

        <!-- Cart item count (badge): Red background with white text -->
        <span class="absolute top-[-4px] right-[-6px] bg-red-500 text-white text-xs font-semibold px-1 py-0.4 rounded-full">
            {{ session('cart') ? array_sum(array_map(fn($item) => $item['quantity'], session('cart'))) : 0 }}
        </span>
    </a>
</div>
