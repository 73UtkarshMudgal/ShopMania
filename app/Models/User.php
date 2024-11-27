<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',   // Add first_name to fillable
        'last_name',    // Add last_name to fillable
        'email',        // Add email to fillable
        'password',     // Add password to fillable
        'phone',        // Add phone to fillable
        'address',      // Add address to fillable
        'address_line2',// Add address_line2 to fillable
        'city',         // Add city to fillable
        'state',        // Add state to fillable
        'country',      // Add country to fillable
        'zip',          // Add zip to fillable
        'is_admin',     // Add is_admin to fillable
        'terms',        // Add terms to fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
