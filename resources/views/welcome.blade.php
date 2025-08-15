<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>EPower - Welcome</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased">
        <!-- Hero Section -->
        <div class="min-h-screen bg-gradient-to-br from-black via-[#1a0000] to-[#8D0907] relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 left-0 w-96 h-96 bg-[#8D0907] rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
                <div class="absolute top-0 right-0 w-96 h-96 bg-[#B91C1C] rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2000"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#DC2626] rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-4000"></div>
            </div>

            <!-- Navigation -->
            <nav class="relative z-10 px-6 py-6">
                <div class="max-w-7xl mx-auto flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg border border-white/30">
                            <i class="fas fa-bolt text-2xl text-white"></i>
                        </div>
                        <span class="text-3xl font-bold text-white">EPower</span>
                    </div>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white/90 hover:text-white transition-colors duration-200 font-medium backdrop-blur-sm px-4 py-2 rounded-lg hover:bg-white/10">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-white/90 hover:text-white transition-colors duration-200 font-medium backdrop-blur-sm px-4 py-2 rounded-lg hover:bg-white/10">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl font-semibold hover:bg-white/30 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 border border-white/30">
                                        <i class="fas fa-user-plus mr-2"></i>
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
                <div class="text-center max-w-5xl mx-auto">
                    <!-- Main Heading -->
                    <h1 class="text-6xl md:text-8xl font-bold text-white mb-8 leading-tight">
                        Welcome to
                        <span class="bg-gradient-to-r from-white via-[#FEF3C7] to-[#FDE68A] bg-clip-text text-transparent">
                            EPower
                        </span>
                    </h1>

                    <!-- Subtitle -->
                    <p class="text-2xl md:text-3xl text-white/80 mb-16 max-w-4xl mx-auto leading-relaxed font-light">
                        Your comprehensive business management solution. Streamline operations, 
                        manage resources efficiently, and power your business to new heights.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-8 justify-center items-center mb-20">
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="group bg-white/20 backdrop-blur-md text-white px-10 py-5 rounded-2xl text-xl font-bold hover:bg-white/30 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-white/25 flex items-center space-x-3 border border-white/30">
                                <span>Go to Dashboard</span>
                                <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-200"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="group bg-white/20 backdrop-blur-md text-white px-10 py-5 rounded-2xl text-xl font-bold hover:bg-white/30 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-white/25 flex items-center space-x-3 border border-white/30">
                                <span>Get Started</span>
                                <i class="fas fa-rocket group-hover:translate-y-[-2px] transition-transform duration-200"></i>
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="group border-2 border-white/50 text-white px-10 py-5 rounded-2xl text-xl font-bold hover:bg-white/20 hover:border-white/80 transition-all duration-300 transform hover:scale-105 flex items-center space-x-3 backdrop-blur-sm">
                                    <span>Sign Up Free</span>
                                    <i class="fas fa-user-plus group-hover:rotate-12 transition-transform duration-200"></i>
                                </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Feature Highlights -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                        <div class="text-center group">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg border border-white/30 group-hover:bg-white/30">
                                <i class="fas fa-users-cog text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">Employee Management</h3>
                            <p class="text-white/70 text-lg leading-relaxed">Comprehensive HR management with attendance tracking, salary management, and performance monitoring</p>
                        </div>

                        <div class="text-center group">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg border border-white/30 group-hover:bg-white/30">
                                <i class="fas fa-chart-line text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">Business Analytics</h3>
                            <p class="text-white/70 text-lg leading-relaxed">Real-time insights and reports to make data-driven decisions and optimize business performance</p>
                        </div>

                        <div class="text-center group">
                            <div class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg border border-white/30 group-hover:bg-white/30">
                                <i class="fas fa-cogs text-3xl text-white"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-4">Process Automation</h3>
                            <p class="text-white/70 text-lg leading-relaxed">Streamline workflows and automate repetitive tasks to increase productivity and efficiency</p>
                        </div>
                    </div>

                    <!-- Additional Features -->
                    <div class="mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                        <div class="text-center group">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-white/20 transition-all duration-300 border border-white/20">
                                <i class="fas fa-calendar-alt text-2xl text-white/90"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-white mb-2">Event Management</h4>
                            <p class="text-white/60 text-sm">Organize and track company events</p>
                        </div>

                        <div class="text-center group">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-white/20 transition-all duration-300 border border-white/20">
                                <i class="fas fa-file-invoice text-2xl text-white/90"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-white mb-2">Invoice System</h4>
                            <p class="text-white/60 text-sm">Professional billing and payment tracking</p>
                        </div>

                        <div class="text-center group">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-white/20 transition-all duration-300 border border-white/20">
                                <i class="fas fa-university text-2xl text-white/90"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-white mb-2">Bank Management</h4>
                            <p class="text-white/60 text-sm">Centralized banking operations</p>
                        </div>

                        <div class="text-center group">
                            <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-white/20 transition-all duration-300 border border-white/20">
                                <i class="fas fa-user-tie text-2xl text-white/90"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-white mb-2">Client Relations</h4>
                            <p class="text-white/60 text-sm">Manage customer relationships</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Elements -->
            <div class="absolute top-1/4 left-10 w-3 h-3 bg-white/60 rounded-full animate-bounce"></div>
            <div class="absolute top-1/3 right-20 w-4 h-4 bg-white/40 rounded-full animate-bounce animation-delay-1000"></div>
            <div class="absolute bottom-1/4 left-1/4 w-3 h-3 bg-white/80 rounded-full animate-bounce animation-delay-2000"></div>
            <div class="absolute top-1/2 right-1/4 w-2 h-2 bg-white/50 rounded-full animate-bounce animation-delay-3000"></div>
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
            .animation-delay-3000 {
                animation-delay: 3s;
            }
            .animation-delay-4000 {
                animation-delay: 4s;
            }
        </style>
    </body>
</html>
