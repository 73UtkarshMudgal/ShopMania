<!-- resources/views/about/index.blade.php -->

@extends('layouts.app')

@section('title', 'About the Project')

@section('meta_description', 'Learn more about our college project and the goals we aim to achieve.')

@section('content')
    <section class="bg-gray-50 py-16 sm:py-20 lg:py-24">
        <div class="max-w-7xl mx-auto px-6 sm:px-8">
            <!-- Heading -->
            <h1 class="text-4xl font-extrabold text-center text-gray-900 sm:text-5xl">
                About the Project
            </h1>

            <!-- Project Overview -->
            <div class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto">
                <p class="text-center">
                    Our college project is designed to address real-world challenges through technology. As a group of four students, we are committed to delivering a solution that not only meets academic standards but also demonstrates our abilities in web development, design, and collaboration.
                </p>
            </div>

            <!-- Project Goals Section -->
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                <div class="text-center bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Innovative Solution</h3>
                    <p class="mt-4 text-gray-500">
                        Our goal is to provide a creative solution to a real-world problem. By combining modern technology and user-centered design, we aim to develop an innovative product that will stand out.
                    </p>
                </div>

                <div class="text-center bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Collaboration</h3>
                    <p class="mt-4 text-gray-500">
                        As a team, we value communication, coordination, and mutual respect. Our collaboration is key to making this project a success, ensuring that every task is tackled efficiently and effectively.
                    </p>
                </div>

                <div class="text-center bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900">Cutting-edge Technology</h3>
                    <p class="mt-4 text-gray-500">
                        We are utilizing the latest tools and technologies, including web development frameworks, responsive design, and robust backend systems, to ensure that our solution is modern, scalable, and user-friendly.
                    </p>
                </div>
            </div>

            <!-- Project Challenges -->
            <div class="mt-16 text-center text-lg text-gray-600 max-w-2xl mx-auto">
                <h2 class="text-3xl font-semibold text-gray-900">Challenges We Faced</h2>
                <p class="mt-6">
                    During the development of this project, we encountered several challenges that helped us grow as a team. From technical obstacles to managing timelines, each challenge became an opportunity to learn and improve. We believe these experiences will make our final product stronger and more resilient.
                </p>
            </div>

            <!-- Conclusion Section -->
            <div class="mt-16 text-center text-lg text-gray-600 max-w-2xl mx-auto">
                <h2 class="text-3xl font-semibold text-gray-900">The Future of the Project</h2>
                <p class="mt-6">
                    Looking ahead, we plan to refine the project further based on feedback, ensuring that it meets the needs of real users. We aim to present our solution to a wider audience, hoping to make a meaningful impact and contribute to our field of study.
                </p>
            </div>
        </div>
    </section>
@endsection
