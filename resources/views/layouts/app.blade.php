<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name'))</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Majime Japanese Language Academy - Learn Japanese in a professional environment')">
    <meta name="keywords" content="@yield('keywords', 'Japanese language, Japanese courses, Learn Japanese, Japanese Academy')">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-primary-600 hover:text-primary-700 transition-colors">
                            <span class="font-serif">MJLA</span>
                        </a>
                    </div>
                    
                    <!-- Desktop Navigation Links -->
                    <div class="hidden md:ml-6 md:flex md:space-x-8">
                        <a href="{{ url('/') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->is('/') ? 'text-primary-600 border-b-2 border-primary-600' : 'text-gray-700 hover:text-primary-600' }}">
                            {{ __('messages.nav.home') }}
                        </a>
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium {{ request()->is('courses*') ? 'text-primary-600 border-b-2 border-primary-600' : 'text-gray-700 hover:text-primary-600' }}">
                            {{ __('messages.nav.courses') }}
                        </a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-primary-600">
                            {{ __('messages.nav.visa_services') }}
                        </a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-primary-600">
                            {{ __('messages.nav.about') }}
                        </a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-primary-600">
                            {{ __('messages.nav.contact') }}
                        </a>
                    </div>
                </div>
                
                <!-- Right side - Language Switcher & Mobile Menu Button -->
                <div class="flex items-center">
                    <!-- Language Switcher -->
                    <div class="hidden sm:flex items-center space-x-2 mr-4">
                        <button onclick="switchLanguage('en')" class="px-2 py-1 text-sm {{ app()->getLocale() == 'en' ? 'text-primary-600 font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                            EN
                        </button>
                        <span class="text-gray-300">|</span>
                        <button onclick="switchLanguage('si')" class="px-2 py-1 text-sm {{ app()->getLocale() == 'si' ? 'text-primary-600 font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                            සිං
                        </button>
                        <span class="text-gray-300">|</span>
                        <button onclick="switchLanguage('ja')" class="px-2 py-1 text-sm {{ app()->getLocale() == 'ja' ? 'text-primary-600 font-semibold' : 'text-gray-500 hover:text-gray-700' }}">
                            日本語
                        </button>
                    </div>
                    
                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-primary-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                        <svg class="h-6 w-6" :class="{ 'hidden': mobileMenuOpen, 'block': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="md:hidden"
             style="display: none;">
            <div class="pt-2 pb-3 space-y-1 bg-white border-t">
                <a href="{{ url('/') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->is('/') ? 'border-primary-600 text-primary-600 bg-primary-50' : 'border-transparent text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                    {{ __('messages.nav.home') }}
                </a>
                <a href="{{ route('courses.index') }}" class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->is('courses*') ? 'border-primary-600 text-primary-600 bg-primary-50' : 'border-transparent text-gray-700 hover:bg-gray-50 hover:border-gray-300' }}">
                    {{ __('messages.nav.courses') }}
                </a>
                <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300">
                    {{ __('messages.nav.visa_services') }}
                </a>
                <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300">
                    {{ __('messages.nav.about') }}
                </a>
                <a href="#" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300">
                    {{ __('messages.nav.contact') }}
                </a>
            </div>
            <!-- Mobile Language Switcher -->
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center justify-center space-x-4">
                    <button onclick="switchLanguage('en')" class="px-3 py-2 text-sm {{ app()->getLocale() == 'en' ? 'text-primary-600 font-semibold' : 'text-gray-500' }}">
                        English
                    </button>
                    <button onclick="switchLanguage('si')" class="px-3 py-2 text-sm {{ app()->getLocale() == 'si' ? 'text-primary-600 font-semibold' : 'text-gray-500' }}">
                        සිංහල
                    </button>
                    <button onclick="switchLanguage('ja')" class="px-3 py-2 text-sm {{ app()->getLocale() == 'ja' ? 'text-primary-600 font-semibold' : 'text-gray-500' }}">
                        日本語
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" data-flash-message>
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg animate-fade-in-up">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto flex-shrink-0 text-green-500 hover:text-green-700">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
    
    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4" data-flash-message>
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg animate-fade-in-up">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-auto flex-shrink-0 text-red-500 hover:text-red-700">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white border-t mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-bold font-serif text-primary-400 mb-4">MJLA</h3>
                    <p class="text-gray-300 mb-4">
                        {{ __('messages.footer.about') }}
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm4.441 16.892c-2.102.144-6.784.144-8.883 0C5.282 16.736 5.017 15.622 5 12c.017-3.629.285-4.736 2.558-4.892 2.099-.144 6.782-.144 8.883 0C18.718 7.264 18.982 8.378 19 12c-.018 3.629-.285 4.736-2.559 4.892zM10 9.658l4.917 2.338L10 14.342V9.658z"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">{{ __('messages.footer.quick_links') }}</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-300 hover:text-primary-400 transition-colors">{{ __('messages.nav.home') }}</a></li>
                        <li><a href="{{ route('courses.index') }}" class="text-gray-300 hover:text-primary-400 transition-colors">{{ __('messages.nav.courses') }}</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors">{{ __('messages.nav.visa_services') }}</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors">{{ __('messages.nav.about') }}</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-primary-400 transition-colors">{{ __('messages.nav.contact') }}</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">{{ __('messages.footer.contact_info') }}</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Colombo, Sri Lanka</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>info@mjla.lk</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+94 XX XXX XXXX</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 text-sm">
                    © {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.footer.all_rights_reserved') }} | 
                    <a href="#" class="hover:text-primary-400 transition-colors">{{ __('messages.footer.privacy_policy') }}</a> | 
                    <a href="#" class="hover:text-primary-400 transition-colors">{{ __('messages.footer.terms_of_service') }}</a>
                </p>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="hidden fixed bottom-8 right-8 bg-primary-600 text-white p-3 rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 z-40 no-print">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    @stack('scripts')
</body>
</html>
