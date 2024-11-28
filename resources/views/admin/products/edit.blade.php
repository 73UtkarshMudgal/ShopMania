@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Edit Product</h1>

    <!-- Display validation errors if any -->
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Product Edit Form -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter product name">
        </div>

        <!-- Product Description -->
        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" rows="5" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- MRP and Price -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <!-- MRP -->
            <div>
                <label for="mrp" class="block text-gray-700 font-medium mb-2">MRP</label>
                <input type="number" name="mrp" id="mrp" value="{{ $product->mrp }}" step="0.01" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter MRP">
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input type="number" name="price" id="price" value="{{ $product->price }}" step="0.01" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter price">
            </div>
        </div>

        <!-- Quantity -->
        <div class="mb-6">
            <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter quantity">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center">
            <button type="submit" class="text-white font-medium bg-black hover:bg-yellow-500 hover:text-black px-6 py-3 rounded-md transition duration-200 ease-in-out">
                Update Product
            </button>

            <!-- Cancel Button -->
            <a href="{{ route('admin.products') }}" class="text-gray-500 font-medium hover:bg-gray-200 hover:text-gray-700 px-6 py-3 rounded-md transition duration-200 ease-in-out">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
