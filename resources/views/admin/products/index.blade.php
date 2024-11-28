@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-6">Manage Products</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Navigation and Search Form -->
    <div class="flex justify-center mb-6">
        <a href="{{ route('admin.products') }}" class="text-black hover:text-gray-600">
            <i class="fas fa-arrow-left text-2xl"></i>
        </a>
        <div class="px-4"></div>
        <!-- Search Form -->
        <form method="GET" action="{{ route('admin.products') }}" class="flex">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="border rounded-l px-4 py-2 w-80">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600">Search</button>
        </form>
    </div>

    <!-- Add Product Button -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.products.create') }}" class="bg-black text-gray-500 hover:bg-yellow-500 hover:text-white px-6 py-3 rounded-md transition duration-200 ease-in-out">
            Add Product
        </a>
    </div>

    <!-- Products Table -->
    <table class="table-auto w-full border-collapse border text-left">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Image</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">MRP</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Quantity</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">
                        @if($product->image)
                            <img src="{{ asset(str_replace('images/images/', 'images/', $product->image) ?: 'images/default-product.jpg') }}" class="w-16 h-16 object-cover rounded-md">
                        @else
                            No Image
                        @endif
                    </td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->description }}</td>
                    <td class="border px-4 py-2">₹{{ number_format($product->mrp, 2) }}</td>
                    <td class="border px-4 py-2">₹{{ number_format($product->price, 2) }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 mr-2 hover:text-blue-700">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-2 text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
