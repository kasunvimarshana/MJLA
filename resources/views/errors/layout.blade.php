@extends('layouts.app')

@section('title', ($code ?? 'Error') . ' - ' . ($message ?? 'An Error Occurred'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Icon -->
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <!-- Error Code -->
        @if(isset($code))
        <h1 class="text-9xl font-bold text-gray-600 mb-4">{{ $code }}</h1>
        @endif

        <!-- Error Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            {{ $message ?? __('messages.errors.generic.title', ['default' => 'An Error Occurred']) }}
        </h2>

        <!-- Error Description -->
        <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto">
            @if(isset($code) && $code == 403)
                {{ __('messages.errors.403.description', ['default' => 'Sorry, you don\'t have permission to access this resource.']) }}
            @elseif(isset($code) && $code == 419)
                {{ __('messages.errors.419.description', ['default' => 'Your session has expired. Please refresh the page and try again.']) }}
            @elseif(isset($code) && $code == 429)
                {{ __('messages.errors.429.description', ['default' => 'Too many requests. Please slow down and try again later.']) }}
            @else
                {{ __('messages.errors.generic.description', ['default' => 'We encountered an unexpected error. Please try again or contact us if the problem persists.']) }}
            @endif
        </p>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            @if(isset($code) && $code == 419)
            <button onclick="location.reload()" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ __('messages.errors.generic.refresh', ['default' => 'Refresh Page']) }}
            </button>
            @else
            <a href="javascript:history.back()" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('messages.errors.generic.go_back', ['default' => 'Go Back']) }}
            </a>
            @endif

            <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('messages.errors.generic.home', ['default' => 'Home Page']) }}
            </a>
        </div>

        <!-- Help Section -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-lg mx-auto">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ __('messages.errors.generic.need_help', ['default' => 'Need Help?']) }}
            </h3>
            <p class="text-sm text-gray-600 mb-4">
                {{ __('messages.errors.generic.help_text', ['default' => 'If you continue to experience issues, please don\'t hesitate to reach out to us.']) }}
            </p>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                {{ __('messages.errors.generic.contact', ['default' => 'Contact Support']) }}
            </a>
        </div>

        <!-- Debug Info (only in debug mode) -->
        @if(config('app.debug') && isset($exception))
        <div class="mt-8 text-left">
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-red-800 mb-2">Debug Information (visible only in development)</h4>
                <p class="text-xs text-red-700 font-mono break-all">
                    {{ $exception->getMessage() }}
                </p>
                @if($exception->getFile())
                <p class="text-xs text-red-600 mt-2">
                    File: {{ $exception->getFile() }}:{{ $exception->getLine() }}
                </p>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
