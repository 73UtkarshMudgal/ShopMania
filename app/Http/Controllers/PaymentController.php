<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Ensure that the user is logged in before accessing checkout
    public function checkout()
    {
        // If the user is not authenticated, they will be redirected to the login page automatically
        return view('checkout');
    }

    public function pay(Request $request)
    {
        // Handle payment process (e.g., interact with a payment gateway)
        // After payment success, redirect to a success page
        return redirect()->route('success.pay');
    }

    public function response(Request $request)
    {
        // Handle payment response from the payment gateway
        // Depending on success or failure, redirect accordingly
        return $request->has('success') 
            ? redirect()->route('success.pay') 
            : redirect()->route('cart')->with('error', 'Payment Failed');
    }

    public function paymentSuccess()
    {
        return view('payment-success'); // A simple view to show payment success message
    }
}
