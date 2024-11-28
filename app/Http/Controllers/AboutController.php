<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    // Show the about page
    public function index()
    {
        // You can pass additional data to the view if needed
        return view('about.index');
    }
}
