<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Full Name -->
        <div class="mt-4">
            <x-main-input-label for="full_name" :value="__('Full Name')" />
        </div>

        <!-- First Name and Last Name using Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- First Name -->
            <div>
                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                <x-hint-label for="first_name" :value="__('First Name')" />
                <x-input-error :messages="$errors->get('first_name')" />
            </div>

            <!-- Last Name -->
            <div>
                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                <x-hint-label for="last_name" :value="__('Last Name')" />
                <x-input-error :messages="$errors->get('last_name')" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-main-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-main-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <!-- Shipping Address -->
        <div class="mt-4">
            <x-main-input-label for="address" :value="__('Shipping Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address-line1" />
            <x-hint-label for="address" :value="__('Address Line 1')" />
            <x-input-error :messages="$errors->get('address')" />
        </div>

        <!-- Address Line 2 (Optional) -->
        <div class="mt-4">
            <x-text-input id="address_line2" class="block mt-1 w-full" type="text" name="address_line2" :value="old('address_line2')" autocomplete="address-line2" />
            <x-hint-label for="address_line2" :value="__('Address Line 2 (Optional)')" />
            <x-input-error :messages="$errors->get('address_line2')" />
        </div>

        <!-- City and State/Province using Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <!-- Country Dropdown -->
            <div>
                <x-main-input-label for="country" :value="__('Country')" />
                <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="updateStates()">
                    <option value="">Select Country</option>
                    <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>USA</option>
                    <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                </select>
                <x-input-error :messages="$errors->get('country')" />
            </div>

            <!-- State/Province Dropdown -->
            <div>
                <x-main-input-label for="state" :value="__('State/Province')" />
                <select id="state" name="state" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="updateCities()">
                    <option value="">Select State/Province</option>
                    <!-- States will be populated dynamically based on the country -->
                </select>
                <x-input-error :messages="$errors->get('state')" />
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
        <!-- City Dropdown -->
        <div class="mt-4">
            <x-main-input-label for="city" :value="__('City')" />
            <select id="city" name="city" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Select City</option>
                <!-- Cities will be populated dynamically based on the selected state -->
            </select>
            <x-input-error :messages="$errors->get('city')" />
        </div>

        <!-- Zip/Postal Code -->
        <div class="mt-4">
            <x-main-input-label for="zip" :value="__('Zip/Postal Code')" />
            <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip')" required autocomplete="postal-code" />
            <x-input-error :messages="$errors->get('zip')" />
        </div>
        </div>
        <!-- Password -->
        <div class="mt-4">
            <x-main-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-main-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Terms and Conditions Checkbox -->
        <div class="mt-4 flex items-center space-x-4">
            <!-- Checkbox Input -->
            <input type="checkbox" id="terms" name="terms" class="form-checkbox text-indigo-600" value="1" required />
            <!-- Terms Label -->
            <label for="terms" class="text-sm">
                {{ __('I agree to the terms and conditions') }}
            </label>
        </div>

        <!-- Already Registered and Register Button -->
        <div class="mt-4 flex items-center justify-between">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        // Example data structure for states and cities (this can come from an API or backend)
        const statesData = {
            'India': ['Maharashtra', 'Karnataka', 'Delhi', 'Tamil Nadu'],
            'USA': ['California', 'Florida', 'New York'] // USA states
        };

        const citiesData = {
            'Maharashtra': ['Mumbai', 'Pune', 'Nagpur', 'Nashik'],
            'Karnataka': ['Bangalore', 'Mysore', 'Hubli', 'Mangalore'],
            'Delhi': ['New Delhi', 'Faridabad', 'Gurgaon'],
            'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai'],
            'California': ['Los Angeles', 'San Francisco', 'San Diego'],
            'Florida': ['Miami', 'Orlando', 'Tampa'],
            'New York': ['New York City', 'Buffalo', 'Rochester'] // New York cities
        };

        // Update States based on selected Country
        function updateStates() {
            const country = document.getElementById('country').value;
            const stateDropdown = document.getElementById('state');
            stateDropdown.innerHTML = '<option value="">Select State/Province</option>'; // Clear previous options

            if (country && statesData[country]) {
                statesData[country].forEach(state => {
                    const option = document.createElement('option');
                    option.value = state;
                    option.text = state;
                    stateDropdown.appendChild(option);
                });
            }
        }

        // Update Cities based on selected State
        function updateCities() {
            const state = document.getElementById('state').value;
            const cityDropdown = document.getElementById('city');
            cityDropdown.innerHTML = '<option value="">Select City</option>'; // Clear previous options

            if (state && citiesData[state]) {
                citiesData[state].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.text = city;
                    cityDropdown.appendChild(option);
                });
            }
        }

    </script>
</x-guest-layout>
