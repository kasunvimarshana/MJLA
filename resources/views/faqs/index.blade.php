@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-page-header 
            title="Frequently Asked Questions" 
            subtitle="Find answers to common questions about our courses, admission, and services"
        />

        @if($categories->isNotEmpty())
        <div class="mb-8">
            <nav class="flex flex-wrap gap-2">
                <a href="{{ route('faqs.index') }}" class="px-4 py-2 rounded-lg bg-primary-100 text-primary-700 font-medium">
                    All
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('faqs.index', ['category' => $cat]) }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                    {{ ucfirst($cat) }}
                </a>
                @endforeach
            </nav>
        </div>
        @endif

        <div class="space-y-4">
            @foreach($faqs as $faq)
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden" x-data="{ open: false }">
                <button 
                    @click="open = !open"
                    class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 transition"
                >
                    <span class="font-medium text-gray-900">{{ $faq->question }}</span>
                    <svg 
                        class="w-5 h-5 text-gray-500 transition-transform"
                        :class="{ 'rotate-180': open }"
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div 
                    x-show="open"
                    x-transition
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200"
                >
                    <p class="text-gray-600">{{ $faq->answer }}</p>
                    <div class="mt-4 flex items-center text-sm text-gray-500">
                        <span class="px-2 py-1 bg-gray-200 rounded text-xs">{{ ucfirst($faq->category) }}</span>
                        <span class="ml-4">{{ $faq->views }} views</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
