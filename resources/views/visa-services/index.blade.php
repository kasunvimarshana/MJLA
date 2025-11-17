@extends('layouts.app')

@section('title', 'Visa Services')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-page-header 
            title="Visa Services" 
            subtitle="Professional visa application support to help you achieve your dream of living and working in Japan"
        />

        @if($featured->isNotEmpty())
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featured as $service)
                <x-card>
                    <div class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium inline-block mb-3">
                        {{ ucfirst($service->category) }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 120) }}</p>
                    <div class="flex items-center justify-between text-sm mb-4">
                        <span class="text-gray-600">Processing: {{ $service->processing_days }} days</span>
                        <span class="font-bold text-primary-600">LKR {{ number_format($service->fee, 2) }}</span>
                    </div>
                    <a href="{{ route('visa-services.show', $service->slug) }}" class="text-primary-600 hover:text-primary-700 font-medium">
                        Learn More →
                    </a>
                </x-card>
                @endforeach
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
            <x-card>
                <div class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium inline-block mb-3">
                    {{ ucfirst($service->category) }}
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $service->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 120) }}</p>
                <div class="flex items-center justify-between text-sm mb-4">
                    <span class="text-gray-600">Processing: {{ $service->processing_days }} days</span>
                    <span class="font-bold text-gray-900">LKR {{ number_format($service->fee, 2) }}</span>
                </div>
                <a href="{{ route('visa-services.show', $service->slug) }}" class="text-primary-600 hover:text-primary-700 font-medium">
                    Learn More →
                </a>
            </x-card>
            @endforeach
        </div>
    </div>
</div>
@endsection
