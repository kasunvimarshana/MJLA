@extends('layouts.app')

@section('title', __('Request Visa Consultation'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                <h1 class="text-3xl font-bold text-white">{{ __('Request a Consultation') }}</h1>
                <p class="text-indigo-100 mt-2">{{ __('Get expert guidance for your visa application to Japan') }}</p>
            </div>

            <div class="p-8">
                @if(session('success'))
                    <x-alert type="success" class="mb-6">
                        {{ session('success') }}
                    </x-alert>
                @endif

                <!-- Selected Service Info -->
                @if($visaService)
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                {{ __('Consultation for:') }} <span class="font-semibold">{{ $visaService->title }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('consultation-requests.store') }}" method="POST" class="space-y-6">
                    @csrf

                    @if($visaService)
                        <input type="hidden" name="visa_service_id" value="{{ $visaService->id }}">
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Full Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Email Address') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Phone Number') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('phone') border-red-500 @enderror" required>
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Visa Type -->
                        <div>
                            <label for="visa_type" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Visa Type') }} <span class="text-red-500">*</span>
                            </label>
                            <select id="visa_type" name="visa_type"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('visa_type') border-red-500 @enderror" required>
                                <option value="">{{ __('Select visa type') }}</option>
                                <option value="student" {{ old('visa_type') == 'student' ? 'selected' : '' }}>{{ __('Student Visa') }}</option>
                                <option value="work" {{ old('visa_type') == 'work' ? 'selected' : '' }}>{{ __('Work Visa') }}</option>
                                <option value="business" {{ old('visa_type') == 'business' ? 'selected' : '' }}>{{ __('Business Visa') }}</option>
                                <option value="tourist" {{ old('visa_type') == 'tourist' ? 'selected' : '' }}>{{ __('Tourist Visa') }}</option>
                                <option value="other" {{ old('visa_type') == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                            </select>
                            @error('visa_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Preferred Date -->
                        <div>
                            <label for="preferred_date" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Preferred Date') }}
                            </label>
                            <input type="date" id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('preferred_date') border-red-500 @enderror">
                            @error('preferred_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preferred Time -->
                        <div>
                            <label for="preferred_time" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Preferred Time') }}
                            </label>
                            <input type="time" id="preferred_time" name="preferred_time" value="{{ old('preferred_time') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('preferred_time') border-red-500 @enderror">
                            @error('preferred_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Your Message') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="5"
                                  placeholder="{{ __('Tell us about your visa needs, timeline, and any specific questions...') }}"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('message') border-red-500 @enderror" required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between pt-4 border-t">
                        <a href="{{ $visaService ? route('visa-services.show', $visaService->slug) : route('visa-services.index') }}" 
                           class="text-gray-600 hover:text-gray-900 font-medium">
                            ← {{ __('Back') }}
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transform transition hover:scale-105 shadow-lg">
                            {{ __('Submit Request') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Box -->
        <div class="mt-8 bg-white rounded-lg shadow-lg p-6 border-l-4 border-indigo-500">
            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('What to expect') }}
            </h3>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold mr-3">1</span>
                    <span>{{ __('Our visa experts will review your request within 1 business day') }}</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold mr-3">2</span>
                    <span>{{ __('You will receive an email confirmation with available consultation times') }}</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold mr-3">3</span>
                    <span>{{ __('Consultations can be conducted in-person, via phone, or video call') }}</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold mr-3">4</span>
                    <span>{{ __('Free initial consultation (30 minutes) to discuss your visa application') }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
