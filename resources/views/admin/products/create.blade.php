@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Product</h1>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full border px-4 py-2">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" class="w-full border px-4 py-2" rows="5"></textarea>
        </div>
        

        <div class="mb-4">
            <label for="mrp" class="block text-gray-700">MRP</label>
            <input type="number" name="mrp" id="mrp" step="0.01" class="w-full border px-4 py-2">
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price</label>
            <input type="number" name="price" id="price" step="0.01" class="w-full border px-4 py-2">
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="w-full border px-4 py-2">
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Image</label>
            <input type="file" name="image" id="image" class="w-full border px-4 py-2">
        </div>

        <button type="submit" class="text-gray-500 font-medium bg-black hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">Add Product</button>
    </form>
</div>
@endsection
