@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Heading -->
        @if(isset($searchQuery))
         <h1 class="text-2xl sm:text-3xl md:text-3xl lg:text-4xl font-semibold text-center mb-6">
             Results for "{{ $searchQuery }}"
         </h1>
         @else
         <h1 class="text-2xl sm:text-3xl md:text-3xl lg:text-4xl font-semibold text-center mb-6">
          Our Products
         </h1>
         @endif


        <!-- Check if products exist -->
        @if(count($products) > 0)
            <!-- Grid setup with responsive columns, fixed width for cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 justify-center">
                @foreach($products as $product)
                    <!-- Card with fixed width and responsive layout -->
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 max-w-[250px] flex flex-col h-[400px]" x-data="{ open: false }">
                        <div class="image-container w-full h-48 sm:h-56 md:h-60 lg:h-68 overflow-hidden mb-4 relative">
                            <!-- Image inside the container -->
                            <img 
                                src="{{ asset(str_replace('images/images/', 'images/', $product->image) ?: 'images/default-product.jpg') }}" 
                                class="w-full h-full object-contain rounded-md mb-4 cursor-pointer"
                                @click="open = true" 
                            >
                        </div>

                        <!-- Product Name -->
                        <h5 class="text-sm font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h5>
                        
                        <!-- Product Price with Discount -->
                        <div class="mb-2">
                            <span class="text-lg font-bold text-green-600">₹{{ number_format($product->price) }}</span>
                            @if($product->mrp > $product->price)
                                <span class="text-sm text-gray-500 line-through ml-2">₹{{ number_format($product->mrp) }}</span>
                                <span class="text-sm text-red-500 ml-2">({{ round((($product->mrp - $product->price) / $product->mrp) * 100) }}% off)</span>
                            @endif
                        </div>

                        <!-- Add to Cart Button -->
                        <div class="flex mt-auto w-full">
                            @if($product->quantity > 0)
                            <a href="{{ route('add-cart', [$product->id]) }}" class="w-full py-2 bg-green-500 text-white text-center rounded-lg hover:bg-green-600 transition">
                            <i class="fas fa-shopping-cart"></i> Add To Cart
                            </a>
                            @else
                                <a class="w-full py-2 bg-gray-400 text-black text-center rounded-lg cursor-not-allowed">
                                    Out of Stock
                                </a>
                            @endif
                        </div>

                        <!-- Modal for Product Image -->
                        <div x-show="open" x-transition.duration.300ms class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white bg-opacity-90 rounded-lg shadow-lg max-w-lg w-full p-6 relative">
                                <!-- Close Button -->
                                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800" @click="open = false">×</button>
                                
                                <!-- Image inside Modal -->
                                <div class="text-center">
                                    <img 
                                        src="{{ asset(str_replace('images/images/', 'images/', $product->image) ?: 'images/default-product.jpg') }}" 
                                        class="w-full h-full object-contain rounded-md mb-4">
                                </div>

                                <!-- Product Details -->
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h3>
                                <p class="text-lg text-green-600 font-bold mb-4">₹{{ number_format($product->price) }}</p>
                                <p class="text-gray-600">{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <p class="text-center col-12 mt-6">No products available at the moment.</p>
        @endif
    </div>
@endsection
