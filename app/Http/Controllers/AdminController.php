<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // Display all products for admin
    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('admin.products.create');
    }

    // Store a new product
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mrp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Make sure the image is validated as an image
        ]);

        // Handle image upload directly to public/images
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Generate a unique name for the image
            $imageName = time() . '-' . $image->getClientOriginalName();
            // Define the destination path
            $destinationPath = public_path('images');
            // Move the uploaded file to the public/images directory
            $image->move($destinationPath, $imageName);
            // Save the image path to the validated data (store it as a string in database)
            $validated['image'] = 'images/' . $imageName;
        }

        // Create the product with validated data including image path
        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Product added successfully.');
    }

    // Show edit form for a specific product
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // Update a specific product
    public function update(Request $request, $id)
    {
        // Validate the incoming request for update
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'mrp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Only allow image upload if file is provided
        ]);

        $product = Product::findOrFail($id);

        // Handle image upload during update
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && File::exists(public_path($product->image))) {
                File::delete(public_path($product->image));
            }
            // Upload new image to public/images
            $image = $request->file('image');
            $imageName = time() . '-' . $image->getClientOriginalName();
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageName);
            // Save the new image path to the validated data
            $validated['image'] = 'images/' . $imageName;
        }

        // Update the product with validated data
        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the image if it exists
        if ($product->image && File::exists(public_path($product->image))) {
            File::delete(public_path($product->image));
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
