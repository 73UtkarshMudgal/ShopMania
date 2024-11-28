@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Add New Product</h1>

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

    <!-- Product Form -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-6">
            <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter product name">
        </div>

        <div class="mb-6">
            <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
            <textarea name="description" id="description" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" rows="5" placeholder="Enter product description"></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="mrp" class="block text-gray-700 font-medium mb-2">MRP</label>
                <input type="number" name="mrp" id="mrp" step="0.01" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter MRP">
            </div>

            <div>
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input type="number" name="price" id="price" step="0.01" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter price">
            </div>
        </div>

        <div class="mb-6">
            <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Enter quantity">
        </div>

        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-medium mb-2">Product Image</label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
        </div>

        <div class="flex justify-center">
            <button type="submit" class="text-white font-medium bg-black hover:bg-yellow-500 hover:text-black px-6 py-3 rounded-md transition duration-200 ease-in-out">
                Add Product
            </button>
        </div>
    </form>
</div>
@endsection
