<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Pass other data to the view as needed (remove $testimonials)
        return view('home.index');
    }
}
