@extends('layouts.app')

@section('content')

<div class="container mt-5" style="background-color: ivory;">
    <h1 class="text-center mb-4"><b>My Cart</b></h1>

    <!-- Success Message -->
    @if(session('success'))
        <div id="successMessage" class="bg-green-500 text-white p-4 rounded-lg mb-6 flex justify-between items-center">
            <span>{{ session('success') }}</span>
            <button type="button" class="text-white font-bold" onclick="this.parentElement.style.display='none'">
                &times;
            </button>
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
                            @php
                                // Get the product from the database
                                $product = \App\Models\Product::find($id);

                                // Ensure product exists and check stock availability
                                $isOutOfStock = $product && $details['quantity'] > $product->quantity;
                            @endphp

                            <tr>
                                <td>
                                    <img 
                                        src="{{ asset(str_replace('images/images/', 'images/', $details['image']) ?: 'images/default-product.jpg') }}" 
                                        style="width: 110px; height: auto; object-fit: contain; border-radius: 8px;" 
                                        alt="{{ $details['name'] }}">
                                </td>
                                <td>{{ $details['name'] }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="updateQuantity({ $id }, 'decrease')">-</button>
                                        <span id="quantity-{{ $id }}" class="mx-2" data-max-stock="{{ $product->quantity }}">{{ $details['quantity'] }}</span>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="updateQuantity({ $id }, 'increase')">+</button>
                                    </div>
                                    @if($isOutOfStock)
                                        <span class="text-danger">Quantity exceeds available stock. Maximum allowed: {{ $product->quantity }}</span>
                                    @endif
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
    // Automatically dismiss the success message after 3 seconds
    setTimeout(function() {
        let successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.display = 'none'; // Hide the success message
        }
    }, 3000); // 3000ms = 3 seconds

    // Update Quantity
    function updateQuantity(id, action) {
        let quantitySpan = document.getElementById(`quantity-${id}`);
        let currentQuantity = parseInt(quantitySpan.innerText);
        let maxStock = parseInt(quantitySpan.getAttribute('data-max-stock'));

        console.log("Current Quantity:", currentQuantity);
        console.log("Max Stock:", maxStock);

        // Prevent updating quantity if item is out of stock
        if (maxStock <= 0) {
            alert("This item is out of stock and cannot be updated.");
            return;
        }

        // Handle quantity updates based on action
        if (action === 'increase' && currentQuantity < maxStock) {
            currentQuantity++;
        } else if (action === 'decrease' && currentQuantity > 1) {
            currentQuantity--;
        }

        // Update the span with the new quantity
        quantitySpan.innerText = currentQuantity;

        // Update Cart via AJAX
        updateCart(id, currentQuantity);
    }

    // Update Cart via AJAX
    function updateCart(id, quantity) {
        fetch('/cart/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id: id,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            // Handle the response and update the UI accordingly
            if (data.success) {
                // Update the total items and cart total dynamically
                document.getElementById("totalItems").innerText = data.totalItems;
                document.getElementById("cartTotal").innerText = data.cartTotal;
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error updating cart:', error);
        });
    }
</script>
@endsection
