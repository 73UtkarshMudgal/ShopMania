<?php

// app/Http/Controllers/ContactController.php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact.index'); // Return the contact form view
    }
    public function submitForm(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Temporarily commenting out the mail sending part
        // Mail::to('admin@example.com')->send(new ContactFormSubmitted($request->all()));

        // Log the data to ensure it's being passed correctly (optional)
       

        // Return back with a success message
        return redirect()->route('contact.form')->with('success', 'Your message has been sent!');
    }
}
