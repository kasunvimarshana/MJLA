@extends('layouts.app')

@section('title', 'Student Testimonials')

@section('content')
<div class="bg-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-page-header 
            title="Student Testimonials" 
            subtitle="Hear from our successful students who achieved their dreams of studying in Japan"
        />

        @if($featured->isNotEmpty())
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featured as $testimonial)
                <x-card>
                    <div class="text-center">
                        <div class="flex items-center justify-center mb-4">
                            @for($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                        </div>
                        <p class="text-gray-600 mb-4 italic">"{{ $testimonial->content }}"</p>
                        <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                        @if($testimonial->position || $testimonial->company)
                        <p class="text-sm text-gray-500">
                            {{ $testimonial->position }}@if($testimonial->position && $testimonial->company), @endif{{ $testimonial->company }}
                        </p>
                        @endif
                        @if($testimonial->course)
                        <p class="text-sm text-primary-600 mt-2">{{ $testimonial->course }}</p>
                        @endif
                    </div>
                </x-card>
                @endforeach
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($testimonials as $testimonial)
            <x-card>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        @endfor
                    </div>
                </div>
                <p class="text-gray-600 mb-4">{{ $testimonial->content }}</p>
                <div>
                    <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                    @if($testimonial->position || $testimonial->company)
                    <p class="text-sm text-gray-500">
                        {{ $testimonial->position }}@if($testimonial->position && $testimonial->company), @endif{{ $testimonial->company }}
                    </p>
                    @endif
                    @if($testimonial->course)
                    <p class="text-sm text-primary-600 mt-1">{{ $testimonial->course }}</p>
                    @endif
                </div>
            </x-card>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $testimonials->links() }}
        </div>
    </div>
</div>
@endsection
