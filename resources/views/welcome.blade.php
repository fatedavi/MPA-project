<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EPower - Welcome</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Alternatif PNG -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/mpa_logo.png') }}">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite (Laravel Asset) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        /* Hero Background */
        .hero-bg {
            background: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab') center/cover no-repeat;
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.8), rgba(141, 9, 7, 0.6));
        }

        /* Bounce Animation */
        .animate-bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            53%,
            80%,
            100% {
                transform: translate3d(0, 0, 0);
            }

            40%,
            43% {
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

        /* Footer Gradient */
        .footer-gradient {
            backdrop-filter: blur(0px);
        }

        /* Social Icons */
        .social-icon {
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
            filter: brightness(1.2);
        }
    </style>
</head>

<body class="font-sans antialiased">

    <!-- Hero Section (Main + Footer menyatu) -->
    <div class="hero-bg relative overflow-hidden">
        <!-- Navigation -->
        <nav class="px-6 py-6 relative z-10">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg border border-white/30">
                        <i class="fas fa-bolt text-2xl text-white"></i>
                    </div>
                    <span class="text-3xl font-bold text-white">EPower</span>
                </div>

                <!-- Auth Buttons -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="text-white/90 hover:text-white transition-colors duration-200 font-medium backdrop-blur-sm px-4 py-2 rounded-lg hover:bg-white/10">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-white/90 hover:text-white transition-colors duration-200 font-medium backdrop-blur-sm px-4 py-2 rounded-lg hover:bg-white/10">
                                <i class="fas fa-sign-in-alt mr-2"></i> Log in
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center px-6 relative z-10">
            <div class="text-center max-w-5xl mx-auto">
                <!-- Heading -->
                <h1 class="text-6xl md:text-8xl font-bold text-white mb-8 leading-tight">
                    Welcome to
                    <span
                        class="bg-gradient-to-r from-white via-[#FEF3C7] to-[#FDE68A] bg-clip-text text-transparent">EPower</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-2xl md:text-3xl text-white/80 mb-16 max-w-4xl mx-auto leading-relaxed font-light">
                    Your comprehensive business management solution. Streamline operations, manage resources
                    efficiently, and power your business to new heights.
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
                            <i class="fas fa-rocket group-hover:-translate-y-1 transition-transform duration-200"></i>
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
                        <div
                            class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg border border-white/30 group-hover:bg-white/30">
                            <i class="fas fa-users-cog text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Employee Management</h3>
                        <p class="text-white/70 text-lg leading-relaxed">Comprehensive HR management with attendance
                            tracking, salary management, and performance monitoring</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg border border-white/30 group-hover:bg-white/30">
                            <i class="fas fa-chart-line text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Business Analytics</h3>
                        <p class="text-white/70 text-lg leading-relaxed">Real-time insights and reports to make
                            data-driven decisions and optimize business performance</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-20 h-20 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg border border-white/30 group-hover:bg-white/30">
                            <i class="fas fa-cogs text-3xl text-white"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Process Automation</h3>
                        <p class="text-white/70 text-lg leading-relaxed">Streamline workflows and automate repetitive
                            tasks to increase productivity and efficiency</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Floating Dots -->
        <div class="absolute top-1/4 left-10 w-3 h-3 bg-white/60 rounded-full animate-bounce z-20"></div>
        <div
            class="absolute top-1/3 right-20 w-4 h-4 bg-white/40 rounded-full animate-bounce animation-delay-1000 z-20">
        </div>
        <div
            class="absolute bottom-1/4 left-1/4 w-3 h-3 bg-white/80 rounded-full animate-bounce animation-delay-2000 z-20">
        </div>
        <div
            class="absolute top-1/2 right-1/4 w-2 h-2 bg-white/50 rounded-full animate-bounce animation-delay-3000 z-20">
        </div>

        <!-- Footer Section -->
        <footer class="footer-gradient relative z-20">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-lg flex items-center justify-center shadow-lg border border-white/30">
                                <i class="fas fa-bolt text-xl text-white"></i>
                            </div>
                            <span class="text-2xl font-bold text-white">EPower</span>
                        </div>
                        <p class="text-white/70 leading-relaxed">Empowering businesses with comprehensive management
                            solutions. Streamline your operations and achieve greater efficiency with our innovative
                            platform.</p>
                        <!-- Social Media -->
                        <div class="flex space-x-4">
                            <a href="#"
                                class="social-icon w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 border border-white/20">
                                <i class="fab fa-facebook-f text-white"></i>
                            </a>
                            <a href="#"
                                class="social-icon w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 border border-white/20">
                                <i class="fab fa-twitter text-white"></i>
                            </a>
                            <a href="#"
                                class="social-icon w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 border border-white/20">
                                <i class="fab fa-linkedin-in text-white"></i>
                            </a>
                            <a href="#"
                                class="social-icon w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center hover:bg-white/20 border border-white/20">
                                <i class="fab fa-instagram text-white"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-white">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-chevron-right text-xs mr-2"></i>Home</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-chevron-right text-xs mr-2"></i>Features</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-chevron-right text-xs mr-2"></i>Pricing</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-chevron-right text-xs mr-2"></i>About Us</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-chevron-right text-xs mr-2"></i>Contact</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-white">Services</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-users text-xs mr-2"></i>Employee Management</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-chart-bar text-xs mr-2"></i>Business Analytics</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-calendar text-xs mr-2"></i>Event Management</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-file-invoice-dollar text-xs mr-2"></i>Invoice System</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white flex items-center"><i
                                        class="fas fa-university text-xs mr-2"></i>Bank Management</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-white">Get in Touch</h3>
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-white/70 mt-1"></i>
                                <div>
                                    <p class="text-white/70">123 Business Street</p>
                                    <p class="text-white/70">Surabaya, East Java 60123</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-phone text-white/70"></i>
                                <p class="text-white/70">+62 31 123 4567</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-white/70"></i>
                                <p class="text-white/70">info@epower.com</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-clock text-white/70"></i>
                                <p class="text-white/70">Mon - Fri: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="pt-8 mb-8">
                    <div class="text-center max-w-2xl mx-auto">
                        <h3 class="text-2xl font-bold text-white mb-4">Stay Updated</h3>
                        <p class="text-white/70 mb-4">Subscribe to our newsletter for the latest updates and business
                            tips
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                            <input type="email" placeholder="Enter your email"
                                class="flex-1 px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/60 backdrop-blur-sm focus:outline-none focus:border-white/40 focus:bg-white/20">
                            <button
                                class="px-6 py-3 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-all duration-300 backdrop-blur-sm border border-white/30 hover:border-white/50">
                                <i class="fas fa-paper-plane mr-2"></i>Subscribe
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="pt-6">
                    <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-white/60 text-center md:text-left">
                            <p>&copy; 2024 EPower. All rights reserved.</p>
                        </div>
                        <div class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm">
                            <a href="#" class="text-white/60 hover:text-white">Privacy Policy</a>
                            <a href="#" class="text-white/60 hover:text-white">Terms of Service</a>
                            <a href="#" class="text-white/60 hover:text-white">Cookie Policy</a>
                            <a href="#" class="text-white/60 hover:text-white">Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>