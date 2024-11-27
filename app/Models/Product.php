<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the table name (optional, if the table name matches the plural of the model name, you can skip this)
    protected $table = 'products';

    // Allow mass assignment for the following fields
    protected $fillable = [
        'name',
        'price',
        'mrp',
        'image',
        'description',
        'quantity',
    ];

    // If you want to cast certain fields to a specific data type, such as decimals or dates
    protected $casts = [
        'price' => 'decimal:2',
        'mrp' => 'decimal:2',
        'quantity' => 'integer',
    ];

    // Optionally, you can define accessors, mutators, or any additional methods if needed

    // Accessor to return the correct path for the image in the public/images folder
    public function getImageAttribute($value)
    {
        return asset('images/' . $value);  // This will generate the correct URL to the image in the public/images folder
    }

    // Example: Accessor for price with currency formatting (optional)
    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2);
    }

    // Example: Accessor for MRP with currency formatting (optional)
    public function getMrpFormattedAttribute()
    {
        return number_format($this->mrp, 2);
    }
}
