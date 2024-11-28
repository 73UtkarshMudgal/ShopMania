<!-- Logo Component -->
<div class="flex items-center space-x-2">
    <a href="{{ Auth::check() && Auth::user()->is_admin ? route('admin.products') : '/' }}" class="text-2xl font-bold text-white hover:text-gray-300">
        ShopMania
    </a>
</div>
