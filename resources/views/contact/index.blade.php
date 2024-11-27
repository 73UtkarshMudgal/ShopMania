@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-12 px-6">
        <h1 class="text-3xl font-bold text-center mb-8">Contact Us</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button type="button" class="text-white font-bold" onclick="this.parentElement.style.display='none'">
                    &times; <!-- This is the "X" symbol -->
                </button>
            </div>
        @endif

        <!-- Contact Form -->
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 p-3 border w-full rounded-md text-gray-700" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-3 border w-full rounded-md text-gray-700" required>
            </div>

            <!-- Message -->
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="4" class="mt-1 p-3 border w-full rounded-md text-gray-700" required></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 focus:outline-none">
                    Send Message
                </button>
            </div>
        </form>
    </div>
@endsection
