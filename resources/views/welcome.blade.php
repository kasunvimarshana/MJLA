<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }}</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Majime Japanese Language Academy - Master the Japanese language with expert instruction and comprehensive courses">
    <meta name="keywords" content="Japanese language, Japanese courses, Learn Japanese, Japanese Academy, MJLA">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <h1 class="text-2xl font-bold text-primary-600">{{ config('app.name') }}</h1>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-primary-600 to-primary-800 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-5xl font-bold mb-4">
                    Welcome to Majime Japanese Language Academy
                </h2>
                <p class="text-xl mb-8 text-primary-100">
                    Master the Japanese language with expert instruction and comprehensive courses
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-primary-600 bg-white hover:bg-gray-50">
                        Explore Courses
                    </a>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white hover:bg-primary-700">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h3 class="text-3xl font-bold text-gray-900 mb-8 text-center">Our Services</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Courses -->
                <a href="{{ route('courses.index') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="text-primary-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Japanese Courses</h4>
                    <p class="text-gray-600">From beginner to advanced, find the perfect course for your level</p>
                </a>

                <!-- Visa Services -->
                <a href="{{ route('visa-services.index') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="text-primary-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Visa Services</h4>
                    <p class="text-gray-600">Professional visa application support for studying in Japan</p>
                </a>

                <!-- FAQs -->
                <a href="{{ route('faqs.index') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="text-primary-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">FAQs</h4>
                    <p class="text-gray-600">Find answers to common questions about our services</p>
                </a>

                <!-- News & Events -->
                <a href="{{ route('news.index') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="text-primary-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">News & Events</h4>
                    <p class="text-gray-600">Stay updated with our latest news and upcoming events</p>
                </a>

                <!-- Staff -->
                <a href="{{ route('staff.index') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="text-primary-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Our Staff</h4>
                    <p class="text-gray-600">Meet our experienced and dedicated teaching staff</p>
                </a>

                <!-- Testimonials -->
                <a href="{{ route('testimonials.index') }}" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <div class="text-primary-600 mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Testimonials</h4>
                    <p class="text-gray-600">Read success stories from our satisfied students</p>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-sm text-gray-400">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </p>
                <p class="text-gray-400 mt-2">
                    &copy; {{ date('Y') }} Majime Japanese Language Academy. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
