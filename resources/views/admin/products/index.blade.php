@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4 text-center">Manage Products</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex  justify-center">

    <a href="{{ route('admin.products') }}" class="text-white hover:text-gray-300 ">
    <i class="fas fa-arrow-left text-black text-2xl"></i> 
    </a>
    <div class="flex px-2"> </div>
    <!-- Search Form -->
    <form method="GET" action="{{ route('admin.products') }}" class="mb-4 flex justify-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="border rounded-l px-4 py-2">
        <button type="submit" class="bg-blue-500 text-blue px-4 py-2 rounded-r">Search</button>
    </form>
    </div>
    
    

    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.products.create') }}" class="bg-black text-gray-500 hover:bg-yellow-500 hover:text-white px-4 py-2 rounded-md transition duration-200 ease-in-out">
            Add Product
        </a>
    </div>

    <table class="table-auto w-full border">
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
                <tr>
   
                    <td class="border px-4 py-2">
                        @if($product->image)
                            <img src="{{ asset(str_replace('images/images/', 'images/', $product->image) ?: 'images/default-product.jpg') }}" class="w-16 h-16 object-cover">
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
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 mr-2">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
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

    <!-- Add pagination links here -->
    <div class="mt-4">
        {{ $products->appends(['search' => request('search')])->links() }}
    </div>

</div>
@endsection
