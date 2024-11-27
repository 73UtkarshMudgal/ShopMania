<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'id' => 2,
                'name' => 'OnePlus Nord CE 3 Lite 5G',
                'price' => 15668,
                'mrp' => 19999,
                'image' => 'images/2.jpg',
                'description' => 'This is another sample product description.',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 0,
            ],
            [
                'id' => 3,
                'name' => 'Apple iPhone 15',
                'price' => 65000,
                'mrp' => 79600,
                'image' => 'images/3.jpg',
                'description' => 'This is a sample product description.',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 9,
            ],
            [
                'id' => 4,
                'name' => 'OPPO F27 Pro+ 5G',
                'price' => 29999,
                'mrp' => 34999,
                'image' => 'images/4.jpg',
                'description' => 'This is another sample product description.',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 20,
            ],
            [
                'id' => 5,
                'name' => 'Samsung Galaxy Z Fold4 5G',
                'price' => 88499,
                'mrp' => 177999,
                'image' => 'images/5.jpg',
                'description' => 'Beige Colour, 12GB RAM, 256GB Storage with No Cost EMI/Additional Exchange Offers',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 6,
            ],
            [
                'id' => 8,
                'name' => 'Apple MacBook Air Laptop',
                'price' => 59990,
                'mrp' => 89900,
                'image' => 'images/1732700225-Screenshot 2024-11-27 142330.png',
                'description' => 'Apple M1 chip, 13.3-inch/33.74 cm Retina Display, 8GB RAM, 256GB SSD Storage, Backlit Keyboard, FaceTime HD Camera, Touch ID. Works with iPhone/iPad; Space Grey',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 20,
            ],
            [
                'id' => 9,
                'name' => 'boAt Airdopes 300 Premium',
                'price' => 1200,
                'mrp' => 6490,
                'image' => 'images/1732700407-Screenshot 2024-11-27 150953.png',
                'description' => 'boAt Airdopes 300 Premium Truly Wireless in-Ear Earbuds with 4 Mics AI-ENx Spatial Audio,50HRS Playtime,Multipoint Connection,ASAP Charge, Hearables App, IPX4, BT v5.3 Ear Buds TWS (Gunmetal Black)',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 10,
            ],
        ]);
    }
}
