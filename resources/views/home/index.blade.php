@extends('layouts.app')

@section('content')

<!-- Auto-moving Banner Section (Tailwind CSS styled, fully responsive) -->
<div id="bannerCarousel" class="carousel slide relative w-full" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover">
    <!-- Carousel Indicators (Dots) -->
    <div class="carousel-indicators absolute bottom-2 left-0 right-0 z-10 flex justify-center pb-2">
        <!-- Active Indicator -->
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active bg-white w-4 h-4 mx-2 rounded-full transition-all duration-300" aria-current="true" aria-label="Slide 1"></button>
        
        <!-- Inactive Indicators -->
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1" class="bg-gray-400 w-4 h-4 mx-2 rounded-full transition-all duration-300" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2" class="bg-gray-400 w-4 h-4 mx-2 rounded-full transition-all duration-300" aria-label="Slide 3"></button>
    </div>

    <!-- Carousel Inner -->
    <div class="carousel-inner relative w-full overflow-hidden">
        <!-- Carousel Item 1 (Mobiles Sale) -->
        <div class="carousel-item active relative w-full">
            <img src="{{ asset('images/mobile-sale.jpeg') }}" class="block w-full h-auto max-h-[450px] object-contain mx-auto" alt="Mobiles Sale">
        </div>

        <!-- Carousel Item 2 (Laptops Sale) -->
        <div class="carousel-item relative w-full">
            <img src="{{ asset('images/laptop-sale.jpeg') }}" class="block w-full h-auto max-h-[450px] object-contain mx-auto" alt="Laptops Sale">
        </div>

        <!-- Carousel Item 3 (Mobile Accessories Sale) -->
        <div class="carousel-item relative w-full">
            <img src="{{ asset('images/accessories-sale.jpeg') }}" class="block w-full h-auto max-h-[450px] object-contain mx-auto" alt="Mobile Accessories Sale">
        </div>
    </div>

    <!-- Carousel Controls (Amazon-style Left and Right Arrows) -->
    <button class="carousel-control-prev absolute top-1/2 left-4 z-10 flex items-center justify-center text-white text-lg sm:text-xl md:text-2xl bg-black bg-opacity-40 hover:bg-opacity-60 w-8 h-8 sm:w-10 sm:h-10 lg:w-16 lg:h-16 xl:w-16 xl:h-16 rounded-full transition duration-300 transform -translate-y-1/2" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
        <span class="text-white">&lt;</span> <!-- Left Arrow -->
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next absolute top-1/2 right-4 z-10 flex items-center justify-center text-white text-lg sm:text-xl md:text-2xl bg-black bg-opacity-40 hover:bg-opacity-60 w-8 h-8 sm:w-10 sm:h-10 lg:w-16 lg:h-16 xl:w-16 xl:h-16 rounded-full transition duration-300 transform -translate-y-1/2" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
        <span class="text-white">&gt;</span> <!-- Right Arrow -->
        <span class="visually-hidden">Next</span>
    </button>
</div>

@endsection
