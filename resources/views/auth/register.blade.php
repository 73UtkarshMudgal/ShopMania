<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="address" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="mt-4">
            <x-input-label for="country" :value="__('Country')" />
            <select id="country" name="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Select Country</option>
                <option value="India">India</option>
                <option value="USA">USA</option>
            </select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>

        <!-- State -->
        <div class="mt-4">
            <x-input-label for="state" :value="__('State')" />
            <select id="state" name="state" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Select State</option>
            </select>
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>

        <!-- City -->
        <div class="mt-4">
            <x-input-label for="city" :value="__('City')" />
            <select id="city" name="city" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">Select City</option>
            </select>
            <x-input-error :messages="$errors->get('city')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label for="pin_code" class="block text-sm font-medium text-gray-700">Pin Code</label>
            <input type="number" id="pin_code" name="pin_code" class="mt-1 block w-full border-gray-300 rounded-md">
        </div>
        
        <input type="hidden" id="is_admin" name="is_admin" value="0">

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- JavaScript for Dynamic State and City -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const locations = {
                India: {
                    "Delhi": ["New Delhi", "Dwarka", "Saket"],
                    "Maharashtra": ["Mumbai", "Pune", "Nagpur"],
                    "Karnataka": ["Bangalore", "Mysore", "Hubli"]
                },
                USA: {
                    "California": ["Los Angeles", "San Francisco", "San Diego"],
                    "Texas": ["Houston", "Dallas", "Austin"],
                    "New York": ["New York City", "Buffalo", "Rochester"]
                }
            };

            const countrySelect = document.getElementById('country');
            const stateSelect = document.getElementById('state');
            const citySelect = document.getElementById('city');

            countrySelect.addEventListener('change', function () {
                const country = this.value;
                stateSelect.innerHTML = '<option value="">Select State</option>';
                citySelect.innerHTML = '<option value="">Select City</option>';

                if (locations[country]) {
                    for (const state in locations[country]) {
                        const option = document.createElement('option');
                        option.value = state;
                        option.textContent = state;
                        stateSelect.appendChild(option);
                    }
                }
            });

            stateSelect.addEventListener('change', function () {
                const country = countrySelect.value;
                const state = this.value;
                citySelect.innerHTML = '<option value="">Select City</option>';

                if (locations[country] && locations[country][state]) {
                    locations[country][state].forEach(city => {
                        const option = document.createElement('option');
                        option.value = city;
                        option.textContent = city;
                        citySelect.appendChild(option);
                    });
                }
            });
        });
    </script>
</x-guest-layout>
