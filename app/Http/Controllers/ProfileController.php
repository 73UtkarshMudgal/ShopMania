<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display the profile edit view.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        // Retrieve the currently authenticated user
        $user = Auth::user();
        
        return view('profile.edit', compact('user')); // Pass the user data to the view
    }

    /**
     * Handle the profile update request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'address_line2' => ['nullable', 'string', 'max:500'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'numeric', 'digits_between:4,10'],
            'password' => ['nullable', 'confirmed', 'min:8', 'max:255'],
        ]);

        // Update the user profile information
        try {
            $user->update([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'address_line2' => $validatedData['address_line2'] ?? null,  // Optional field
                'country' => $validatedData['country'],
                'state' => $validatedData['state'],
                'city' => $validatedData['city'],
                'zip' => $validatedData['zip'],
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($validatedData['password'])
                ]);
            }

            // Redirect to profile page with success message
            return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->withErrors(['error' => 'There was an error updating your profile.']);
        }
    }
}
