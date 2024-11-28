<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Display Cart Page
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
        $product = Product::find($productId);

        if ($product) {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity']++;
            } else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'mrp' => $product->mrp,
                    'image' => $product->image ?: 'images/default-product.jpg'
                ];
            }

            session()->put('cart', $cart);

            return redirect()->route('cart')->with('success', 'Item added to cart!');
        }

        return redirect()->route('cart')->with('error', 'Product not found!');
    }

    // Remove Item from Cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart!');
    }

 
    // Update Cart Quantity
public function updateCartQuantity(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'quantity' => 'required|integer|min:1',
    ]);

    $cart = session()->get('cart', []);
    $id = $request->id;
    $quantity = $request->quantity;

    // Check if the item exists in the cart
    if (isset($cart[$id])) {
        // Get the product to check stock
        $product = Product::find($id);

        // Validate stock availability
        if ($quantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Not enough stock available'
            ]);
        }

        // Update the quantity in the cart session
        $cart[$id]['quantity'] = $quantity;
        session()->put('cart', $cart);

        // Calculate the new totals
        $totalItems = array_sum(array_map(fn($item) => $item['quantity'], $cart));
        $cartTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return response()->json([
            'success' => true,
            'totalItems' => $totalItems,
            'cartTotal' => $cartTotal
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Item not found in cart'
    ]);
}

}
