@extends('layouts.app')

@section('title', __('Enroll in') . ' ' . $course->title)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Course Info Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $course->title }}</h1>
            <p class="text-gray-600 mb-4">{{ $course->description }}</p>
            <div class="flex flex-wrap gap-4 text-sm">
                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full">
                    {{ ucfirst($course->level) }}
                </span>
                @if($course->duration_weeks)
                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full">
                    {{ $course->duration_weeks }} weeks
                </span>
                @endif
                @if($course->price)
                <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full font-semibold">
                    LKR {{ number_format($course->price) }}
                </span>
                @endif
            </div>
        </div>

        <!-- Enrollment Form -->
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Enrollment Form') }}</h2>

            @if(session('success'))
                <x-alert type="success" class="mb-6">
                    {{ session('success') }}
                </x-alert>
            @endif

            <form action="{{ route('enrollments.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div>
                    <label for="student_name" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Full Name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="student_name" name="student_name" value="{{ old('student_name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('student_name') border-red-500 @enderror" required>
                    @error('student_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Email Address') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Phone Number') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror" required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Address') }}
                    </label>
                    <textarea id="address" name="address" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('address') }}</textarea>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Additional Notes') }}
                    </label>
                    <textarea id="notes" name="notes" rows="4"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('courses.show', $course->slug) }}" class="text-gray-600 hover:text-gray-900 font-medium">
                        ← {{ __('Back to Course') }}
                    </a>
                    <button type="submit" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transform transition hover:scale-105">
                        {{ __('Submit Enrollment') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">{{ __('What happens next?') }}</h3>
            <ul class="space-y-2 text-blue-800">
                <li>✓ {{ __('We will review your enrollment request within 24 hours') }}</li>
                <li>✓ {{ __('You will receive confirmation via email with payment instructions') }}</li>
                <li>✓ {{ __('Our team will contact you to discuss course details and schedule') }}</li>
            </ul>
        </div>
    </div>
</div>
@endsection
