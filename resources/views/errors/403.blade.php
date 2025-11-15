@extends('layouts.app')

@section('title', '403 - Forbidden')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Icon -->
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-9xl font-bold text-red-600 mb-4">403</h1>

        <!-- Error Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            {{ __('messages.errors.403.title', ['default' => 'Access Forbidden']) }}
        </h2>

        <!-- Error Description -->
        <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto">
            {{ __('messages.errors.403.description', ['default' => 'Sorry, you don\'t have permission to access this resource. This area is restricted.']) }}
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="javascript:history.back()" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('messages.errors.403.go_back', ['default' => 'Go Back']) }}
            </a>

            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('messages.errors.403.home', ['default' => 'Home Page']) }}
            </a>
        </div>

        <!-- Information Box -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-lg mx-auto">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ __('messages.errors.403.why_title', ['default' => 'Why am I seeing this?']) }}
            </h3>
            <ul class="text-left space-y-3 text-gray-600 text-sm">
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.403.reason1', ['default' => 'You may not have the necessary permissions']) }}
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.403.reason2', ['default' => 'You may need to log in with proper credentials']) }}
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.403.reason3', ['default' => 'The resource may be restricted to specific users']) }}
                </li>
            </ul>
        </div>

        <!-- Help Section -->
        <div class="mt-8">
            <p class="text-sm text-gray-600">
                {{ __('messages.errors.403.help_text', ['default' => 'If you believe this is an error,']) }}
                <a href="{{ route('contact.index') }}" class="text-primary-600 hover:text-primary-700 underline">
                    {{ __('messages.errors.403.contact_link', ['default' => 'please contact us']) }}
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
