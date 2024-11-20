@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Checkout</h1>

    @if(session('cart'))
    <h4>Your Cart</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $product)
            <tr>
                <td>{{ $product['name'] }}</td>
                <td>${{ $product['price'] }}</td>
                <td>{{ $product['quantity'] }}</td>
                <td>${{ $product['price'] * $product['quantity'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('pay') }}" method="POST">
        @csrf
        <div class="form-group">
            <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </div>
    </form>
    
    @else
    <p>Your cart is empty. Please add products to your cart before proceeding to checkout.</p>
    <a href="{{ route('products') }}" class="btn btn-primary">Back to Shop</a>
    @endif
</div>
@endsection
