<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PKL Project Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-950 text-gray-100 font-inter overflow-x-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-400/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-emerald-600/5 rounded-full blur-3xl animate-pulse delay-500"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative bg-gray-900/80 backdrop-blur-xl border-b border-gray-800/50 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-emerald-400 to-emerald-600 bg-clip-text text-transparent">
                            PKL Manager
                        </span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-emerald-400 transition-all duration-300 group">
                                Dashboard
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                        class="relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-red-400 transition-all duration-300 group">
                                    Logout
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-red-400 to-red-600 transition-all duration-300 group-hover:w-full"></span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                               class="relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-emerald-400 transition-all duration-300 group">
                                Log in
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-300 group-hover:w-full"></span>
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full text-sm font-semibold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-emerald-500/25">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="space-y-8 animate-fade-in-up">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full text-emerald-400 text-sm font-medium backdrop-blur-sm">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></span>
                    Next-Gen PKL Management
                </div>

                <!-- Main Heading -->
                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                    Manage Your
                    <span class="bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 bg-clip-text text-transparent block">
                        PKL Projects
                    </span>
                    Like a Pro
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-gray-400 mb-12 max-w-3xl mx-auto font-light">
                    The ultimate platform for Gen Z students to streamline their Praktik Kerja Lapangan with
                    <span class="text-emerald-400 font-semibold">powerful tools</span> and
                    <span class="text-emerald-400 font-semibold">modern design</span>.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ Route::has('register') ? route('register') : '#' }}"
                       class="group relative px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-2xl text-lg font-bold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-emerald-500/25 min-w-[200px]">
                        <span class="relative z-10">Start Your Journey</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-2xl blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </a>
                    <a href="#features"
                       class="group px-8 py-4 border border-gray-700 text-gray-300 rounded-2xl text-lg font-semibold hover:border-emerald-500 hover:text-emerald-400 transition-all duration-300 backdrop-blur-sm min-w-[200px]">
                        Explore Features
                        <span class="inline-block ml-2 transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-gray-600 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-emerald-400 rounded-full mt-2 animate-pulse"></div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="relative py-32 bg-gradient-to-b from-gray-950 to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">
                    Why Gen Z Loves
                    <span class="bg-gradient-to-r from-emerald-400 to-emerald-600 bg-clip-text text-transparent">
                        PKL Manager
                    </span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Built for the digital generation with cutting-edge features and intuitive design
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group relative bg-gray-900/50 backdrop-blur-sm p-8 rounded-3xl border border-gray-800/50 hover:border-emerald-500/30 transition-all duration-500 hover:transform hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-emerald-400 transition-colors duration-300">
                            Smart Task Management
                        </h3>
                        <p class="text-gray-400 leading-relaxed">
                            AI-powered task organization with drag-and-drop interface, smart reminders, and progress visualization that actually makes sense.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-gray-900/50 backdrop-blur-sm p-8 rounded-3xl border border-gray-800/50 hover:border-emerald-500/30 transition-all duration-500 hover:transform hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-emerald-400 transition-colors duration-300">
                            Real-time Collaboration
                        </h3>
                        <p class="text-gray-400 leading-relaxed">
                            Connect with your team instantly. Chat, share files, get feedback, and collaborate like you're all in the same room - but better.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-gray-900/50 backdrop-blur-sm p-8 rounded-3xl border border-gray-800/50 hover:border-emerald-500/30 transition-all duration-500 hover:transform hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4 group-hover:text-emerald-400 transition-colors duration-300">
                            Lightning Fast
                        </h3>
                        <p class="text-gray-400 leading-relaxed">
                            Built for speed demons. No loading screens, no lag, no frustration. Just pure productivity at the speed of thought.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="relative py-24 bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="space-y-2">
                    <div class="text-4xl font-black text-emerald-400">10K+</div>
                    <div class="text-gray-400 font-medium">Active Students</div>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-black text-emerald-400">500+</div>
                    <div class="text-gray-400 font-medium">Partner Companies</div>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-black text-emerald-400">95%</div>
                    <div class="text-gray-400 font-medium">Success Rate</div>
                </div>
                <div class="space-y-2">
                    <div class="text-4xl font-black text-emerald-400">24/7</div>
                    <div class="text-gray-400 font-medium">Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32 bg-gradient-to-br from-gray-950 via-gray-900 to-emerald-950/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="space-y-8">
                <h2 class="text-4xl md:text-6xl font-black text-white leading-tight">
                    Ready to Level Up Your
                    <span class="bg-gradient-to-r from-emerald-400 to-emerald-600 bg-clip-text text-transparent block">
                        PKL Game?
                    </span>
                </h2>
                <p class="text-xl text-gray-400 max-w-2xl mx-auto">
                    Join the revolution of smart students who are crushing their PKL goals with style and efficiency.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-8">
                    <a href="{{ Route::has('register') ? route('register') : '#' }}"
                       class="group relative px-10 py-5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-2xl text-xl font-bold hover:from-emerald-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-emerald-500/25 min-w-[250px]">
                        <span class="relative z-10">Start Free Today</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-2xl blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </a>
                </div>
                <p class="text-sm text-gray-500">
                    No credit card required • Free forever • Setup in 2 minutes
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative bg-gray-950 border-t border-gray-800/50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold bg-gradient-to-r from-emerald-400 to-emerald-600 bg-clip-text text-transparent">
                            PKL Manager
                        </span>
                    </div>
                    <p class="text-gray-400">
                        Empowering the next generation of professionals through innovative PKL management.
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Product</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">API</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Support</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-white font-semibold mb-4">Company</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Careers</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-gray-400">© {{ date('Y') }} PKL Manager. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 sm:mt-0">
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .font-inter { font-family: 'Inter', sans-serif; }
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>
</html>
