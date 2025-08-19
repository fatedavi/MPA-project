<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PT MULTI POWER ABADI | EPOWER</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <style>
            .hero-bg {
               background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                position: relative;
            }
            .hero-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom right, rgba(0,0,0,0.8), rgba(141,9,7,0.6));
            }
            .animate-bounce {
                animation: bounce 1s infinite;
            }
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
            .animation-delay-1000 {
                animation-delay: 1s;
            }
            .animation-delay-2000 {
                animation-delay: 2s;
            }
            .animation-delay-3000 {
                animation-delay: 3s;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Hero Section with Background Image -->
        <div class="min-h-screen hero-bg relative overflow-hidden">
            <!-- Content with higher z-index -->
            <div class="relative z-10">
                <!-- Navigation -->
                <nav class="px-6 py-6">
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
                                @endauth
                            </div>
                        @endif
                    </div>
                </nav>

                <!-- Main Content -->
                <div class="flex items-center justify-center min-h-[calc(100vh-80px)] px-6">
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
                                    <a href="{{ route('login') }}" 
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
                        <div class="py-20 mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
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
            </div>

            <!-- Floating Elements -->
            <div class="absolute top-1/4 left-10 w-3 h-3 bg-white/60 rounded-full animate-bounce z-20"></div>
            <div class="absolute top-1/3 right-20 w-4 h-4 bg-white/40 rounded-full animate-bounce animation-delay-1000 z-20"></div>
            <div class="absolute bottom-1/4 left-1/4 w-3 h-3 bg-white/80 rounded-full animate-bounce animation-delay-2000 z-20"></div>
            <div class="absolute top-1/2 right-1/4 w-2 h-2 bg-white/50 rounded-full animate-bounce animation-delay-3000 z-20"></div>
        </div>

        <!-- Footer Section -->
        <footer class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 relative z-10">
            <div class="max-w-7xl mx-auto px-6 py-16">
                <!-- Main Footer Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg border border-white/30">
                                <i class="fas fa-bolt text-xl text-white"></i>
                            </div>
                            <span class="text-2xl font-bold text-white">EPower</span>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed">
                            Your comprehensive business management solution. Streamline operations, 
                            manage resources efficiently, and power your business to new heights.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20 group">
                                <i class="fab fa-facebook-f text-white/80 group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20 group">
                                <i class="fab fa-twitter text-white/80 group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20 group">
                                <i class="fab fa-linkedin-in text-white/80 group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" class="w-10 h-10 bg-white/10 backdrop-blur-sm rounded-lg flex items-center justify-center hover:bg-white/20 transition-all duration-300 border border-white/20 group">
                                <i class="fab fa-instagram text-white/80 group-hover:text-white transition-colors"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Dashboard
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Employee Management
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Reports & Analytics
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Settings
                            </a></li>
                        </ul>
                    </div>

                    <!-- Features -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white mb-4">Features</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Attendance Tracking
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Salary Management
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Event Management
                            </a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center group">
                                <i class="fas fa-chevron-right text-xs mr-2 text-white/60 group-hover:text-white transition-colors"></i>
                                Invoice System
                            </a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-white/60 mt-1 text-sm"></i>
                                <p class="text-gray-300 text-sm">Jl. Sudirman No. 123, Jakarta Pusat, Indonesia</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-phone text-white/60 text-sm"></i>
                                <p class="text-gray-300 text-sm">+62 21 1234 5678</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-white/60 text-sm"></i>
                                <p class="text-gray-300 text-sm">info@epower.com</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-clock text-white/60 text-sm"></i>
                                <p class="text-gray-300 text-sm">Mon - Fri: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Subscription -->
                <div class="border-t border-white/10 pt-8 mb-8">
                    <div class="max-w-2xl mx-auto text-center">
                        <h3 class="text-xl font-semibold text-white mb-4">Stay Updated</h3>
                        <p class="text-gray-300 mb-6">Subscribe to our newsletter for the latest updates and insights</p>
                        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                            <input type="email" placeholder="Enter your email" 
                                   class="flex-1 px-4 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-white/30 transition-all duration-300">
                            <button class="px-6 py-3 bg-white/20 backdrop-blur-md text-white font-semibold rounded-lg hover:bg-white/30 transition-all duration-300 border border-white/30 hover:border-white/50 flex items-center justify-center space-x-2">
                                <span>Subscribe</span>
                                <i class="fas fa-paper-plane text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-white/10 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-gray-400 text-sm">
                            <p>&copy; 2024 EPower. All rights reserved. | 
                                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a> | 
                                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                            </p>
                        </div>
                        <div class="flex items-center space-x-6 text-sm">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Support</a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">Documentation</a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">API</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>