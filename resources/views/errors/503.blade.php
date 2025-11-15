@extends('layouts.app')

@section('title', '503 - Service Unavailable')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full text-center">
        <!-- Maintenance Icon -->
        <div class="mb-8">
            <svg class="mx-auto h-24 w-24 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <!-- Error Code -->
        <h1 class="text-9xl font-bold text-yellow-600 mb-4">503</h1>

        <!-- Error Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">
            {{ __('messages.errors.503.title', ['default' => 'We\'ll Be Right Back']) }}
        </h2>

        <!-- Error Description -->
        <p class="text-lg text-gray-600 mb-8 max-w-lg mx-auto">
            {{ __('messages.errors.503.description', ['default' => 'Our website is currently undergoing scheduled maintenance. We should be back online shortly. Thank you for your patience!']) }}
        </p>

        <!-- Maintenance Info -->
        <div class="bg-white rounded-lg shadow-md p-6 max-w-lg mx-auto mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                {{ __('messages.errors.503.maintenance_title', ['default' => 'Maintenance in Progress']) }}
            </h3>
            <div class="space-y-3 text-gray-600 text-left">
                <p class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('messages.errors.503.estimated_time', ['default' => 'Estimated downtime: Less than 1 hour']) }}
                </p>
                <p class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    {{ __('messages.errors.503.reason', ['default' => 'We\'re upgrading our systems to serve you better']) }}
                </p>
            </div>
        </div>

        <!-- Action Button -->
        <div class="mb-12">
            <button onclick="location.reload()" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                {{ __('messages.errors.503.check_again', ['default' => 'Check Again']) }}
            </button>
        </div>

        <!-- Contact Info -->
        <div class="bg-gray-100 rounded-lg p-6 max-w-lg mx-auto">
            <h3 class="text-md font-semibold text-gray-900 mb-3">
                {{ __('messages.errors.503.urgent_title', ['default' => 'Need Urgent Assistance?']) }}
            </h3>
            <p class="text-sm text-gray-600 mb-4">
                {{ __('messages.errors.503.urgent_description', ['default' => 'If you have an urgent matter, please contact us directly:']) }}
            </p>
            <div class="space-y-2 text-sm">
                <p class="flex items-center justify-center text-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <a href="mailto:info@mjla.lk" class="text-primary-600 hover:text-primary-700">info@mjla.lk</a>
                </p>
                <p class="flex items-center justify-center text-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    +94 XX XXX XXXX
                </p>
            </div>
        </div>

        <!-- Footer Message -->
        <div class="mt-8 text-sm text-gray-500">
            <p>{{ __('messages.errors.503.thanks', ['default' => 'Thank you for your understanding and patience!']) }}</p>
        </div>
    </div>
</div>

<!-- Auto-refresh script (refresh every 30 seconds) -->
<script>
    setTimeout(function(){
        location.reload();
    }, 30000);
</script>
@endsection
