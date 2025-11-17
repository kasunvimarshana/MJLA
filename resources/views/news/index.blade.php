@extends('layouts.app')

@section('title', 'News & Events')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-page-header 
            title="News & Events" 
            subtitle="Stay updated with the latest news, announcements, and upcoming events"
        />

        @if($featured->isNotEmpty())
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach($featured->take(2) as $item)
                <x-card>
                    <div class="flex items-center gap-2 mb-3">
                        <span class="bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ ucfirst($item->category) }}
                        </span>
                        @if($item->type === 'event')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                            Event
                        </span>
                        @endif
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $item->excerpt }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        @if($item->type === 'event' && $item->event_date)
                        <span>📅 {{ $item->event_date->format('F d, Y') }}</span>
                        @else
                        <span>{{ $item->published_at?->format('F d, Y') }}</span>
                        @endif
                        <span>{{ $item->views }} views</span>
                    </div>
                    <a href="{{ route('news.show', $item->slug) }}" class="text-primary-600 hover:text-primary-700 font-medium">
                        Read More →
                    </a>
                </x-card>
                @endforeach
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($news as $item)
            <x-card>
                <div class="flex items-center gap-2 mb-3">
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                        {{ ucfirst($item->category) }}
                    </span>
                    @if($item->type === 'event')
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                        Event
                    </span>
                    @endif
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $item->title }}</h3>
                <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($item->excerpt, 100) }}</p>
                <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                    @if($item->type === 'event' && $item->event_date)
                    <span>📅 {{ $item->event_date->format('M d, Y') }}</span>
                    @else
                    <span>{{ $item->published_at?->format('M d, Y') }}</span>
                    @endif
                    <span>{{ $item->views }} views</span>
                </div>
                <a href="{{ route('news.show', $item->slug) }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                    Read More →
                </a>
            </x-card>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $news->links() }}
        </div>
    </div>
</div>
@endsection
