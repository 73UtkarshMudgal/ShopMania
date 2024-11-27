<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    
    try {
        // Validate input fields
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'address_line2' => ['nullable', 'string', 'max:500'],
            'zip' => ['required', 'numeric', 'digits_between:4,10'],
            'phone' => ['required', 'string', 'max:20'],
            'terms' => ['required', 'accepted'], // Ensure this is validated
        ]);

       

        // Proceed with creating the user
        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'address_line2' => $validatedData['address_line2'],
            'city' => $validatedData['city'],
            'state' => $validatedData['state'],
            'country' => $validatedData['country'],
            'zip' => $validatedData['zip'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => false, // Default value for non-admin
            'terms' => $validatedData['terms'], // Save the terms value (1 or 0)
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect based on user role
        if ($user->is_admin) {
            return redirect('/admin/dashboard'); // Admin-specific dashboard
        }

        // Redirect non-admin users to the home page or some other page
        return redirect('/');
        
    } catch (\Exception $e) {
        // Catch any exception and log it as an error
        return redirect()->back()->withErrors(['error' => 'There was an error during registration. Please try again.']);
    }
}
}