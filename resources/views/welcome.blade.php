<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MPA Project - Welcome</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <!-- Hero Section -->
        <div class="min-h-screen bg-gradient-to-br from-blue-900 via-purple-900 to-indigo-900 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000"></div>
            </div>

            <!-- Navigation -->
            <nav class="relative z-10 px-6 py-6">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white">MPA Project</span>
                    </div>
                    
                        @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                                @auth
                                <a href="{{ url('/dashboard') }}" class="text-white hover:text-blue-200 transition-colors duration-200">
                                        Dashboard
                                    </a>
                                @else
                                <a href="{{ route('login') }}" class="text-white hover:text-blue-200 transition-colors duration-200">
                                        Log in
                                    </a>
                                    @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-white text-blue-900 px-6 py-2 rounded-full font-medium hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        Sign up
                                        </a>
                                    @endif
                                @endauth
                        </div>
                        @endif
                                </div>
            </nav>

            <!-- Main Content -->
            <div class="relative z-10 flex items-center justify-center min-h-screen px-6">
                <div class="text-center max-w-4xl mx-auto">
                    <!-- Main Heading -->
                    <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                        Welcome to
                        <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                            MPA Project
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-xl md:text-2xl text-blue-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                        Your comprehensive project management solution. Streamline workflows, 
                        collaborate seamlessly, and achieve your goals faster than ever before.
                                            </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="group bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-blue-500/25 flex items-center space-x-2">
                                <span>Go to Dashboard</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="group bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-blue-500/25 flex items-center space-x-2">
                                <span>Get Started</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="group border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-900 transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                                    <span>Sign Up Free</span>
                                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                </a>
                            @endif
                        @endauth
                                </div>

                    <!-- Feature Highlights -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                        <div class="text-center group">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2">Project Management</h3>
                            <p class="text-blue-200">Organize tasks, track progress, and manage deadlines efficiently</p>
                                </div>

                        <div class="text-center group">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2">Team Collaboration</h3>
                            <p class="text-blue-200">Work together seamlessly with real-time updates and communication</p>
                                </div>

                        <div class="text-center group">
                            <div class="w-16 h-16 bg-gradient-to-r from-pink-400 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2">Analytics & Reports</h3>
                            <p class="text-blue-200">Get insights into performance and make data-driven decisions</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Elements -->
            <div class="absolute top-1/4 left-10 w-2 h-2 bg-blue-400 rounded-full animate-bounce"></div>
            <div class="absolute top-1/3 right-20 w-3 h-3 bg-purple-400 rounded-full animate-bounce animation-delay-1000"></div>
            <div class="absolute bottom-1/4 left-1/4 w-2 h-2 bg-pink-400 rounded-full animate-bounce animation-delay-2000"></div>
        </div>

        <style>
            @keyframes bounce {
                0%, 20%, 53%, 80%, 100% {
                    transform: translate3d(0,0,0);
                }
                40%, 43% {
                    transform: translate3d(0, -30px, 0);
                }
                70% {
                    transform: translate3d(0, -15px, 0);
                }
                90% {
                    transform: translate3d(0, -4px, 0);
                }
            }
            .animate-bounce {
                animation: bounce 1s infinite;
            }
            .animation-delay-1000 {
                animation-delay: 1s;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>
    </body>
</html>
