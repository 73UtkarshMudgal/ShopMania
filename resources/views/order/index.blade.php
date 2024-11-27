@extends('layouts.app')

@section('content')

<div class="container mt-5" style="background-color: ivory;">
    <h1 class="text-center mb-4"><b>Order Summary</b></h1>

    <div class="row">
        <!-- Order Summary Details -->
        <div class="col-md-8">
            <h4><strong>Order Details:</strong></h4>
            @if(session('cart') && count(session('cart', [])) > 0)
                <table class="table table-bordered text-center">
                    <thead style="background-color: lightgray;">
                        <tr>
                            <th class="px-5">Image</th>
                            <th class="px-5">Name</th>
                            <th class="px-5">Quantity</th>
                            <th class="px-5">Price</th>
                            <th class="px-5">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart', []) as $id => $details)
                            <tr>
                                <td>
                                    <img 
                                        src="{{ asset($details['image'] ?: 'images/default-product.jpg') }}" 
                                        style="width: 110px; height: auto; object-fit: contain; border-radius: 8px;" 
                                        alt="{{ $details['name'] }}">
                                </td>
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>₹{{ $details['price'] }}</td>
                                <td>₹{{ $details['price'] * $details['quantity'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Your cart is empty!</p>
            @endif
        </div>

        <!-- Order Summary Sidebar -->
        <div class="col-md-4">
            <div class="d-flex flex-column align-items-end">
                <h4><strong>Total Amount:</strong> ₹<span id="totalAmount">{{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart', []))) }}</span></h4>

                <h4><strong>Shipping Charges:</strong> ₹<span id="shippingCharges">50</span></h4> <!-- Static shipping charge for now -->
                
                <h4><strong>Final Amount:</strong> ₹<span id="finalAmount">{{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart', []))) + 50 }}</span></h4> <!-- Total + shipping charges -->
                
                <!-- Form to Place Order (POST method) -->
                <form action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg mt-4">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection



