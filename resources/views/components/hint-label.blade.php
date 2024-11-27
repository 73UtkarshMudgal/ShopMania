@props(['value'])

<p {{ $attributes->merge(['class' => 'text-xs sm:text-sm md:text-base text-gray-500 italic mt-1']) }}>
    {{ $value ?? $slot }}
</p>
