<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class OrderController extends Controller
{
    // Display the order summary page (optional)
    public function index()
    {
        return view('order.index'); // You can customize this view as needed
    }

    // Place an order
    public function placeOrder(Request $request)
    {
        // Get cart data from session
        $cart = session('cart', []);

        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to place an order.');
        }

        // If the cart is empty, redirect back with a message
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        // Calculate the total amount (including shipping charges)
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) + 50; // Add shipping charges (₹50)

        // Create the order record in the database
        $order = new Order();
        $order->user_id = Auth::id();  // Associate the order with the logged-in user
        $order->total_amount = $totalAmount;  // Set total amount for the order
        $order->status = 'pending';  // Set the initial status to 'pending'
        $order->payment_status = 'unpaid';  // Set the initial payment status to 'unpaid'
        $order->save();  // Save the order record

        // Optional: Reduce the stock for each product in the cart
        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                // Reduce stock based on the quantity in the cart
                $product->quantity -= $details['quantity'];
                $product->save();
            }
        }

        // Clear the cart session after placing the order
        session()->forget('cart');

        // Redirect to the cart page with a success message
        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }
}
