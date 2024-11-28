<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional, if different from the pluralized version)
    protected $table = 'orders';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_status',
    ];

    // Define the relationship with the User model (assuming each order belongs to a user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // You can define any other relationships or methods specific to the Order model here
}
