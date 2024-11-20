<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create product records in the database
        Product::create([
            'name' => 'Sample Product',
            'price' => 29.99,
            'image' => 'images/sample-product.jpg', // Ensure this is the relative path to the public folder
            'description' => 'This is a sample product description.',
        ]);

        Product::create([
            'name' => 'Another Product',
            'price' => 19.99,
            'image' => 'images/another-product.jpg',
            'description' => 'This is another sample product description.',
        ]);

        Product::create([
            'name' => 'Product 3',
            'price' => 9.99,
            'image' => 'images/product3.jpg',
            'description' => 'This is another sample product description.',
        ]);
    }
}
