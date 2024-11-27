<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index'); // Ensure 'order.index' matches the view path
    }

    public function placeOrder(Request $request)
    {
        // Logic to place the order
        session()->forget('cart'); // Clear the cart
        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }
}
