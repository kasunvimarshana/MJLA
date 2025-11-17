@extends('layouts.app')

@section('title', $service->title)

@section('content')
<div class="bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('visa-services.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Back to Visa Services
            </a>
        </div>

        <div class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium inline-block mb-4">
            {{ ucfirst($service->category) }} Visa
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $service->title }}</h1>
        
        <div class="flex items-center gap-6 text-sm text-gray-600 mb-8 pb-8 border-b border-gray-200">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ $service->processing_days }} days
            </div>
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                LKR {{ number_format($service->fee, 2) }}
            </div>
        </div>

        <div class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Description</h2>
            <p class="text-gray-600">{{ $service->description }}</p>
        </div>

        @if($service->requirements)
        <div class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Requirements</h2>
            <div class="text-gray-600">{!! nl2br(e($service->requirements)) !!}</div>
        </div>
        @endif

        @if($service->process)
        <div class="prose max-w-none mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Application Process</h2>
            <div class="text-gray-600">{!! nl2br(e($service->process)) !!}</div>
        </div>
        @endif

        <div class="bg-gradient-to-r from-blue-100 to-indigo-100 rounded-lg p-8 mt-8 shadow-md">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Ready to Apply?</h3>
            <p class="text-gray-700 mb-6">Schedule a consultation with our visa experts to discuss your application process and requirements.</p>
            <div class="flex gap-4">
                <a href="{{ route('consultation-requests.create', $service->slug) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transform transition hover:scale-105 shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Request Consultation
                </a>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-lg hover:bg-gray-50 border-2 border-gray-300 shadow">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contact Us
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
