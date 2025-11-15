@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Icon -->
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-9xl font-bold text-primary-600 mb-4">404</h1>

        <!-- Error Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            {{ __('messages.errors.404.title', ['default' => 'Page Not Found']) }}
        </h2>

        <!-- Error Description -->
        <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto">
            {{ __('messages.errors.404.description', ['default' => 'Sorry, we couldn\'t find the page you\'re looking for. The page may have been moved, deleted, or never existed.']) }}
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('messages.errors.404.back_home', ['default' => 'Back to Home']) }}
            </a>

            <a href="{{ route('contact.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {{ __('messages.errors.404.contact_us', ['default' => 'Contact Us']) }}
            </a>
        </div>

        <!-- Helpful Links -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-lg mx-auto">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ __('messages.errors.404.helpful_links', ['default' => 'Here are some helpful links:']) }}
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                <a href="{{ route('courses.index') }}" class="flex items-center text-primary-600 hover:text-primary-700 transition-colors">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    {{ __('messages.nav.courses', ['default' => 'View Courses']) }}
                </a>
                <a href="#" class="flex items-center text-primary-600 hover:text-primary-700 transition-colors">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('messages.nav.visa_services', ['default' => 'Visa Services']) }}
                </a>
                <a href="#" class="flex items-center text-primary-600 hover:text-primary-700 transition-colors">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.nav.about', ['default' => 'About Us']) }}
                </a>
                <a href="{{ route('contact.index') }}" class="flex items-center text-primary-600 hover:text-primary-700 transition-colors">
                    <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    {{ __('messages.nav.contact', ['default' => 'Contact']) }}
                </a>
            </div>
        </div>

        <!-- Search Suggestion -->
        <div class="mt-8 text-sm text-gray-500">
            <p>{{ __('messages.errors.404.tip', ['default' => 'Tip: Check the URL for typos or try searching from the home page.']) }}</p>
        </div>
    </div>
</div>
@endsection
