<x-app-layout>
    @section('content')
    <h2 class="font-bold text-xl text-gray-800 leading-tight text-center mt-8">
        {{ __('Edit Profile') }}
    </h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Full Name -->
                        <div class="mt-4">
                            <x-main-input-label for="full_name" :value="__('Full Name')" />
                        </div>

                        <!-- First Name and Last Name (Only show if required) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <!-- First Name -->
                            <div>
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name', $user->first_name)" required autocomplete="given-name" readonly />
                                <x-hint-label for="first_name" :value="__('First Name')" />
                                <x-input-error :messages="$errors->get('first_name')" />
                            </div>

                            <!-- Last Name -->
                            <div>
                                <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name', $user->last_name)" required autocomplete="family-name" readonly />
                                <x-hint-label for="last_name" :value="__('Last Name')" />
                                <x-input-error :messages="$errors->get('last_name')" />
                            </div>
                        </div>

                        <!-- Email Address (Non-editable) -->
                        <div class="mt-4">
                            <x-main-input-label for="email" :value="__('Email Address')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" readonly />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <!-- Phone Number (Non-editable) -->
                        <div class="mt-4">
                            <x-main-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone', $user->phone)" readonly />
                            <x-input-error :messages="$errors->get('phone')" />
                        </div>

                        <!-- Shipping Address -->
                        <div class="mt-4">
                            <x-main-input-label for="address" :value="__('Shipping Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->address)" required autocomplete="address-line1" />
                            <x-hint-label for="address" :value="__('Address Line 1')" />
                            <x-input-error :messages="$errors->get('address')" />
                        </div>

                        <!-- Address Line 2 (Optional) -->
                        <div class="mt-4">
                            <x-text-input id="address_line2" class="block mt-1 w-full" type="text" name="address_line2" :value="old('address_line2', $user->address_line2)" autocomplete="address-line2" />
                            <x-hint-label for="address_line2" :value="__('Address Line 2 (Optional)')" />
                            <x-input-error :messages="$errors->get('address_line2')" />
                        </div>

                        <!-- Country, State, and City using Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <!-- Country Dropdown -->
                            <div>
                                <x-main-input-label for="country" :value="__('Country')" />
                                <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="updateStates()">
                                    <option value="">Select Country</option>
                                    <option value="USA" {{ old('country', $user->country) == 'USA' ? 'selected' : '' }}>USA</option>
                                    <option value="India" {{ old('country', $user->country) == 'India' ? 'selected' : '' }}>India</option>
                                </select>
                                <x-input-error :messages="$errors->get('country')" />
                            </div>

                            <!-- State/Province Dropdown -->
                            <div>
                                <x-main-input-label for="state" :value="__('State/Province')" />
                                <select id="state" name="state" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="updateCities()">
                                    <option value="">Select State/Province</option>
                                    <!-- States will be populated dynamically based on the selected country -->
                                </select>
                                <x-input-error :messages="$errors->get('state')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <!-- City Dropdown -->
                            <div>
                                <x-main-input-label for="city" :value="__('City')" />
                                <select id="city" name="city" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select City</option>
                                    <!-- Cities will be populated dynamically based on the selected state -->
                                </select>
                                <x-input-error :messages="$errors->get('city')" />
                            </div>

                            <!-- Zip/Postal Code -->
                            <div>
                                <x-main-input-label for="zip" :value="__('Zip/Postal Code')" />
                                <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip', $user->zip)" required autocomplete="postal-code" />
                                <x-input-error :messages="$errors->get('zip')" />
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="mt-4 flex items-center justify-between">
                            <x-primary-button class="ml-4 bg-green-600 hover:bg-green-700 text-white">
                                {{ __('Save Changes') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Example data structure for states and cities (this can come from an API or backend)
        const statesData = {
            'India': ['Maharashtra', 'Karnataka', 'Delhi', 'Tamil Nadu'],
            'USA': ['California', 'Florida', 'New York']
        };

        const citiesData = {
            'Maharashtra': ['Mumbai', 'Pune', 'Nagpur', 'Nashik'],
            'Karnataka': ['Bangalore', 'Mysore', 'Hubli', 'Mangalore'],
            'Delhi': ['New Delhi', 'Faridabad', 'Gurgaon'],
            'Tamil Nadu': ['Chennai', 'Coimbatore', 'Madurai'],
            'California': ['Los Angeles', 'San Francisco', 'San Diego'],
            'Florida': ['Miami', 'Orlando', 'Tampa'],
            'New York': ['New York City', 'Buffalo', 'Rochester']
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

                // Auto-select the state if it's already set
                const selectedState = "{{ old('state', $user->state) }}";
                if (selectedState) {
                    stateDropdown.value = selectedState;
                    updateCities(); // Populate cities based on selected state
                }
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

                // Auto-select the city if it's already set
                const selectedCity = "{{ old('city', $user->city) }}";
                if (selectedCity) {
                    cityDropdown.value = selectedCity;
                }
            }
        }

        // Call updateStates to populate states on page load
        updateStates();
    </script>
    @endsection
</x-app-layout>
