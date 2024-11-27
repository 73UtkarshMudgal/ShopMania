@extends('layouts.app')

@section('content')

<div class="container mt-5" style="background-color: ivory;">
    <h1 class="text-center mb-4"><b>My Cart</b></h1>

    @if(session('success'))
        <div class="alert alert-success text-center" id="successMessage">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Cart Details -->
        <div class="col-md-8">
            @if(session('cart') && count(session('cart')) > 0)
                <table class="table table-bordered text-center">
                    <thead style="background-color: lightgray;">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th class="px-5">Price</th>
                            <th class="px-5">MRP</th>
                            <th class="px-5">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $id => $details)
                            <tr>
                                <td>
                                    <img 
                                        src="{{ asset(str_replace('images/images/', 'images/', $details['image']) ?: 'images/default-product.jpg') }}" 
                                        style="width: 110px; height: auto; object-fit: contain; border-radius: 8px;" 
                                        alt="{{ $details['name'] }}">
                                </td>
                                <td>{{ $details['name'] }}</td>
                                <td>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        value="{{ $details['quantity'] }}" 
                                        class="form-control text-center d-inline w-50 quantity-input" 
                                        min="1" 
                                        data-id="{{ $id }}" 
                                        data-price="{{ $details['price'] }}">
                                </td>
                                <td class="px-3">₹{{ $details['price'] }}</td>
                                <td class="px-3">₹{{ $details['mrp'] ?? 'N/A' }}</td>
                                <td class="px-3">
                                    <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Your cart is empty!</p>
            @endif
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
            <div class="d-flex flex-column align-items-end">
                @if(session('cart') && count(session('cart')) > 0)
                    <h4><strong>Total Items:</strong> <span id="totalItems">{{ array_sum(array_map(fn($item) => $item['quantity'], session('cart', []))) }}</span></h4>
                    <h4><strong>Subtotal:</strong> ₹<span id="cartTotal">{{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart', []))) }}</span></h4>

                    @guest
                        <a href="{{ route('register') }}" class="btn btn-warning btn-lg mt-3">Proceed to Buy</a>
                    @else
                        <a href="{{ route('order.index') }}" class="btn btn-warning btn-lg mt-3">Proceed to Buy</a>
                    @endguest
                @else
                    <p class="text-center text-red-500 mt-2">Please add items to proceed.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Check if the script is being loaded
    console.log("Script is running!");

    // Automatically dismiss the success message after 3 seconds
    setTimeout(function() {
        let successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none'; // Hide the success message
            console.log("Success message hidden!");
        }
    }, 3000); // 3000ms = 3 seconds
</script>
@endsection
