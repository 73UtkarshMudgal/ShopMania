<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Fetch data for admin dashboard if needed
        $stats = [
            'total_users' => 100,
            'total_orders' => 50,
        ];

        return view('admin.dashboard', compact('stats')); // Render the admin dashboard
    }
}
