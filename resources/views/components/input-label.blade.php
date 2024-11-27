@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm sm:text-base md:text-lg lg:text-xl font-semibold text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
