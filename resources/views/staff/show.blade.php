@extends('layouts.app')

@section('title', $staffMember->name)

@section('content')
<div class="bg-white py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('staff.index') }}" class="text-primary-600 hover:text-primary-700">
                ← Back to Staff
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <div class="flex-shrink-0">
                <div class="w-48 h-48 bg-gray-300 rounded-full flex items-center justify-center">
                    <svg class="w-32 h-32 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <div class="flex-1">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $staffMember->name }}</h1>
                <p class="text-xl text-primary-600 font-medium mb-4">{{ $staffMember->position }}</p>
                
                @if($staffMember->department)
                <div class="flex items-center mb-3">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="text-gray-600">{{ $staffMember->department }}</span>
                </div>
                @endif

                @if($staffMember->email)
                <div class="flex items-center mb-3">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <a href="mailto:{{ $staffMember->email }}" class="text-primary-600 hover:text-primary-700">
                        {{ $staffMember->email }}
                    </a>
                </div>
                @endif

                @if($staffMember->phone)
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <a href="tel:{{ $staffMember->phone }}" class="text-primary-600 hover:text-primary-700">
                        {{ $staffMember->phone }}
                    </a>
                </div>
                @endif
            </div>
        </div>

        @if($staffMember->bio)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Biography</h2>
            <div class="text-gray-600 leading-relaxed">
                {!! nl2br(e($staffMember->bio)) !!}
            </div>
        </div>
        @endif

        @if($staffMember->qualifications)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Qualifications</h2>
            <div class="text-gray-600 leading-relaxed">
                {!! nl2br(e($staffMember->qualifications)) !!}
            </div>
        </div>
        @endif

        @if($staffMember->specialization)
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Areas of Specialization</h2>
            <div class="text-gray-600 leading-relaxed">
                {!! nl2br(e($staffMember->specialization)) !!}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
