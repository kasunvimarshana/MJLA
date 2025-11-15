@extends('layouts.app')

@section('title', '500 - Server Error')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Icon -->
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-9xl font-bold text-red-600 mb-4">500</h1>

        <!-- Error Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            {{ __('messages.errors.500.title', ['default' => 'Internal Server Error']) }}
        </h2>

        <!-- Error Description -->
        <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto">
            {{ __('messages.errors.500.description', ['default' => 'Oops! Something went wrong on our end. We\'ve been notified of the issue and are working to fix it. Please try again later.']) }}
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('messages.errors.500.back_home', ['default' => 'Back to Home']) }}
            </a>

            <button onclick="location.reload()" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ __('messages.errors.500.try_again', ['default' => 'Try Again']) }}
            </button>
        </div>

        <!-- What to do -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-lg mx-auto">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ __('messages.errors.500.what_to_do', ['default' => 'What you can do:']) }}
            </h3>
            <ul class="text-left space-y-3 text-gray-600">
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.500.step1', ['default' => 'Wait a few minutes and try again']) }}
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.500.step2', ['default' => 'Refresh the page']) }}
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.500.step3', ['default' => 'Clear your browser cache']) }}
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>
                        {{ __('messages.errors.500.step4_prefix', ['default' => 'If the problem persists,']) }}
                        <a href="{{ route('contact.index') }}" class="text-primary-600 hover:text-primary-700 underline">
                            {{ __('messages.errors.500.step4_link', ['default' => 'contact us']) }}
                        </a>
                    </span>
                </li>
            </ul>
        </div>

        <!-- Additional Info -->
        @if(config('app.debug'))
        <div class="mt-8 text-sm text-gray-500">
            <p class="font-mono bg-gray-100 p-4 rounded text-left overflow-auto">
                Error Code: {{ $exception->getCode() ?? 'Unknown' }}<br>
                @if(isset($exception))
                Message: {{ $exception->getMessage() }}
                @endif
            </p>
        </div>
        @endif

        <div class="mt-8 text-sm text-gray-500">
            <p>{{ __('messages.errors.500.tip', ['default' => 'We apologize for the inconvenience. Our team has been automatically notified.']) }}</p>
        </div>
    </div>
</div>
@endsection
