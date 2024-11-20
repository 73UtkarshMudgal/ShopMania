@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Heading -->
        <h1 class="text-2xl sm:text-3xl md:text-3xl lg:text-4xl font-semibold text-center mb-6">
    Our Products
</h1>


        <!-- Check if products exist -->
        @if(count($products) > 0)
            <!-- Grid setup with responsive columns, fixed width for cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center">
                @foreach($products as $product)
                    <!-- Card with fixed width and responsive layout -->
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 max-w-[250px] flex flex-col h-[400px]">
                    <div class="image-container w-full h-48 sm:h-56 md:h-60 lg:h-68 overflow-hidden mb-4 relative">
    <!-- Image inside the container -->
    <img 
        src="{{ asset($product->image ?: 'images/default-product.jpg') }}" 
        class="w-full h-full object-contain rounded-md mb-4"
    >
</div>



                        <!-- Product Name -->
                        <h5 class="text-sm font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h5>
                        
                        <!-- Product Price with Discount -->
                        <div class="mb-2">
                            <!-- Formatted price with commas -->
                            <span class="text-lg font-bold text-green-600">₹{{ number_format($product->price) }}</span>
                            @if($product->mrp > $product->price)
                                <!-- Original price with strike-through and discount percentage -->
                                <span class="text-sm text-gray-500 line-through ml-2">₹{{ number_format($product->mrp) }}</span>
                                <span class="text-sm text-red-500 ml-2">({{ round((($product->mrp - $product->price) / $product->mrp) * 100) }}% off)</span>
                            @endif
                        </div>

                       
                        <!-- Add to Cart Button -->
                        <div class="flex mt-auto w-full">
                            <a href="{{ route('add-cart', [$product->id]) }}" class="w-full py-2 bg-green-500 text-white text-center rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-shopping-cart"></i> Add To Cart
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-center col-12 mt-6">No products available at the moment.</p>
        @endif
    </div>
@endsection
