@extends('layouts.app')

@section('title', 'Our Staff')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-page-header 
            title="Our Staff" 
            subtitle="Meet our experienced and dedicated team of professionals"
        />

        @if($featured->isNotEmpty())
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Leadership Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featured as $member)
                <x-card>
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto mb-4 bg-gray-300 rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $member->name }}</h3>
                        <p class="text-primary-600 font-medium mb-2">{{ $member->position }}</p>
                        @if($member->department)
                        <p class="text-sm text-gray-500 mb-3">{{ $member->department }}</p>
                        @endif
                        @if($member->bio)
                        <p class="text-sm text-gray-600 mb-4">{{ Str::limit($member->bio, 120) }}</p>
                        @endif
                        <a href="{{ route('staff.show', $member->slug) }}" class="text-primary-600 hover:text-primary-700 font-medium text-sm">
                            View Profile →
                        </a>
                    </div>
                </x-card>
                @endforeach
            </div>
        </div>
        @endif

        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">All Staff Members</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($staff as $member)
                <x-card>
                    <div class="text-center">
                        <div class="w-20 h-20 mx-auto mb-3 bg-gray-200 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900">{{ $member->name }}</h3>
                        <p class="text-sm text-primary-600 mb-1">{{ $member->position }}</p>
                        @if($member->department)
                        <p class="text-xs text-gray-500 mb-3">{{ $member->department }}</p>
                        @endif
                        <a href="{{ route('staff.show', $member->slug) }}" class="text-primary-600 hover:text-primary-700 font-medium text-xs">
                            View Profile →
                        </a>
                    </div>
                </x-card>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
