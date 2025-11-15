@extends('layouts.app')

@section('title', $course->title . ' - ' . config('app.name'))
@section('description', Str::limit($course->description, 160))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        @if($course->image)
            <img src="{{ $course->image }}" alt="{{ $course->title }}" class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                <svg class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        @endif
        
        <div class="p-8">
            <div class="flex items-center justify-between mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                    {{ ucfirst($course->level) }} Level
                </span>
                @if($course->is_featured)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                        Featured Course
                    </span>
                @endif
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $course->title }}</h1>
            
            <div class="flex items-center space-x-6 text-gray-600 mb-6">
                @if($course->duration_weeks)
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $course->duration_weeks }} weeks</span>
                    </div>
                @endif
                
                @if($course->max_students)
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Max {{ $course->max_students }} students</span>
                    </div>
                @endif
            </div>
            
            @if($course->description)
                <div class="prose max-w-none mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Course Description</h2>
                    <p class="text-gray-600">{{ $course->description }}</p>
                </div>
            @endif
            
            @if($course->objectives)
                <div class="prose max-w-none mb-6">
                    <h2 class="text-2xl font-semibold text-gray-900 mb-3">Learning Objectives</h2>
                    <p class="text-gray-600">{{ $course->objectives }}</p>
                </div>
            @endif
            
            <div class="border-t pt-6 flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 mb-1">Course Fee</div>
                    <div class="text-4xl font-bold text-primary-600">¥{{ number_format($course->price, 0) }}</div>
                </div>
                
                <div class="flex space-x-3">
                    <a href="{{ route('courses.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Back to Courses
                    </a>
                    <button class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700">
                        Enroll Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
