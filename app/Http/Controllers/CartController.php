<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Display Cart Page
   // Inside CartController
public function index()
{
    $cartItems = session()->get('cart', []);
    $totalPrice = 0;

    foreach ($cartItems as $item) {
        $totalPrice += $item['price'] * $item['quantity'];
    }

    return view('cart.index', compact('cartItems', 'totalPrice'));
}


    // Add Product to Cart
    public function addToCart($productId)
    {
        // Get the product by its ID
        $product = Product::find($productId);

        if ($product) {
            // Get the cart from the session, or create an empty array if no cart exists
            $cart = session()->get('cart', []);

            // Check if the product is already in the cart
            if (isset($cart[$productId])) {
                // If product exists, increment its quantity
                $cart[$productId]['quantity']++;
            } else {
                // If product is not in the cart, add it with quantity 1
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'mrp'=> $product->mrp,
                    'image' => $product->image ?: 'images/default-product.jpg' // Default image if not available
                ];
            }

            // Store the cart in the session
            session()->put('cart', $cart);

            // Redirect back to the cart page with a success message
            return redirect()->route('cart')->with('success', 'Item added to cart!');
        } else {
            return redirect()->route('cart')->with('error', 'Product not found!');
        }
    }

    // Update Cart Item Quantity
    public function update($id, Request $request)
    {
        // Validate the quantity
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Retrieve the cart session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$id])) {
            // Update the quantity
            $cart[$id]['quantity'] = $request->quantity;

            // Recalculate the subtotal for this product
            $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];

            // Store the updated cart in session
            session()->put('cart', $cart);
        }

        // Return redirect with success message
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    // Remove an Item from the Cart
    public function remove($id)
    {
        $cart = session()->get('cart', []); // Retrieve the cart from the session
    
        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            unset($cart[$id]); // Remove the item
            session()->put('cart', $cart); // Update the session
        }
    
        return redirect()->back()->with('success', 'Item removed from the cart successfully!');
    }

    // Update Cart Quantity via AJAX Request
    public function updateCart(Request $request)
    {
        // Validate the input
        $request->validate([
            'productId' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the product exists in the cart
        if (isset($cart[$request->productId])) {
            // Update the quantity of the product in the cart
            $cart[$request->productId]['quantity'] = $request->quantity;

            // Recalculate the subtotal for this product
            $cart[$request->productId]['subtotal'] = $cart[$request->productId]['quantity'] * $cart[$request->productId]['price'];

            // Update the cart in the session
            session()->put('cart', $cart);
        }

        // Calculate the total order sum
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['subtotal'];
        }

        // Return the updated cart data and the total order sum as JSON
        return response()->json([
            'cart' => $cart,
            'total' => $total
        ]);
    }
}

