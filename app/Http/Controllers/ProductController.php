<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import the Product model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products on the homepage (products page)
    public function index()
    {
        // Retrieve all products and pass them to the view
        $products = Product::all(); 
        return view('products', compact('products')); // Use compact() to pass the variable
    }

    // Show cart page
    public function cart()
    {
        // Get the cart from session
        $cart = session()->get('cart', []);
        return view('cart', compact('cart')); // Pass cart data to the view
    }

    // Add product to the cart
    public function addToCart(Product $product)
    {
        // Retrieve the cart from the session or initialize an empty cart
        $cart = session()->get('cart', []);

        // If product already in cart, increase the quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            // Otherwise, add the product to the cart
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        // Save the cart to the session
        session()->put('cart', $cart);

        // Return a success message
        return redirect()->route('cart')->with('success', "Product added to cart!");
    }

    // Remove product from the cart
    public function removeFromCart($id)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // If the product exists in the cart, remove it
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart); // Update the session cart
        }

        // Return a success message
        return redirect()->route('cart')->with('success', "Product removed from cart!");
    }

    // Change product quantity in the cart
    public function changeQty(Request $request, Product $product)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // If the product is in the cart, update its quantity
        if (isset($cart[$product->id])) {
            if ($request->change_to === 'down' && $cart[$product->id]['quantity'] > 1) {
                // Decrease quantity
                $cart[$product->id]['quantity']--;
            } elseif ($request->change_to === 'up') {
                // Increase quantity
                $cart[$product->id]['quantity']++;
            }

            // Save updated cart to the session
            session()->put('cart', $cart);
        }

        // Redirect back to the cart with a success message
        return redirect()->route('cart')->with('success', "Cart updated!");
    }
}
