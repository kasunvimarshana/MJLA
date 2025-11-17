@extends('layouts.app')

@section('title', $newsItem->title)

@section('content')
<div class="bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('news.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Back to News & Events
            </a>
        </div>

        <div class="flex items-center gap-2 mb-4">
            <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">
                {{ ucfirst($newsItem->category) }}
            </span>
            @if($newsItem->type === 'event')
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                Event
            </span>
            @endif
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $newsItem->title }}</h1>
        
        <div class="flex items-center gap-6 text-sm text-gray-600 mb-8 pb-8 border-b border-gray-200">
            @if($newsItem->type === 'event' && $newsItem->event_date)
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $newsItem->event_date->format('F d, Y') }}
            </div>
            @if($newsItem->event_location)
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $newsItem->event_location }}
            </div>
            @endif
            @else
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ $newsItem->published_at?->format('F d, Y') }}
            </div>
            @endif
            @if($newsItem->author)
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ $newsItem->author->name }}
            </div>
            @endif
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                {{ $newsItem->views }} views
            </div>
        </div>

        @if($newsItem->excerpt)
        <div class="text-xl text-gray-700 mb-8 italic">
            {{ $newsItem->excerpt }}
        </div>
        @endif

        <div class="prose prose-lg max-w-none">
            {!! nl2br(e($newsItem->content)) !!}
        </div>
    </div>
</div>
@endsection
