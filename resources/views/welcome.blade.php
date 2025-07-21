<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Chirper') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
                background-color: #000000;
                color: #e7e9ea;
            }
            
            .hero-gradient {
                background: linear-gradient(135deg, #1d9bf0 0%, #0d84c7 100%);
            }
            
            .feature-card {
                background: rgba(255, 255, 255, 0.03);
                border: 1px solid #2f3336;
                backdrop-filter: blur(10px);
            }
            
            .feature-card:hover {
                background: rgba(255, 255, 255, 0.06);
                transform: translateY(-2px);
                transition: all 0.3s ease;
            }
            
            .btn-primary {
                background-color: #1d9bf0;
                color: white;
                border: none;
                border-radius: 9999px;
                font-weight: 700;
                transition: background-color 0.2s ease;
                padding: 12px 32px;
                font-size: 17px;
            }
            
            .btn-primary:hover {
                background-color: #1a8cd8;
            }
            
            .btn-secondary {
                background-color: transparent;
                color: #1d9bf0;
                border: 1px solid #1d9bf0;
                border-radius: 9999px;
                font-weight: 700;
                transition: all 0.2s ease;
                padding: 12px 32px;
                font-size: 17px;
            }
            
            .btn-secondary:hover {
                background-color: rgba(29, 155, 240, 0.1);
            }
        </style>
    </head>
    <body class="bg-black text-white min-h-screen">
        <!-- Header -->
        <header class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-black bg-opacity-80 border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('chipmunk.svg') }}" alt="Chirper" class="w-8 h-8">
                        <span class="text-2xl font-bold">Chirper</span>
                    </div>
                    
                    @if (Route::has('login'))
                        <nav class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn-primary">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn-secondary">
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn-primary">
                                        Sign up
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="pt-24 pb-16 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-8">
                        <h1 class="text-6xl lg:text-7xl font-black leading-tight">
                            What's<br>
                            <span class="text-blue-400">happening?</span>
                        </h1>
                        <p class="text-2xl text-gray-300 leading-relaxed">
                            Join today and connect with people around the world. Share your thoughts, discover new perspectives, and be part of the conversation.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            @guest
                                <a href="{{ route('register') }}" class="btn-primary inline-block text-center">
                                    Join Chirper today
                                </a>
                                <a href="{{ route('login') }}" class="btn-secondary inline-block text-center">
                                    Already have an account?
                                </a>
                            @else
                                <a href="{{ route('chirps.index') }}" class="btn-primary inline-block text-center">
                                    Start Chirping
                                </a>
                            @endguest
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="hero-gradient rounded-3xl p-8 text-center">
                            <img src="{{ asset('chipmunk.svg') }}" alt="Chirper Logo" class="w-32 h-32 mx-auto mb-6 opacity-90">
                            <h3 class="text-2xl font-bold mb-4">See what's happening</h3>
                            <p class="text-lg opacity-90">Join the conversation and discover new voices from around the world.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-16 px-6 border-t border-gray-800">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4">Why Chirper?</h2>
                    <p class="text-xl text-gray-300">Simple, fast, and built for real conversations</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="feature-card rounded-2xl p-8 text-center">
                        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Express Yourself</h3>
                        <p class="text-gray-300">Share your thoughts in 280 characters or less. Every voice matters.</p>
                    </div>
                    
                    <div class="feature-card rounded-2xl p-8 text-center">
                        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Connect</h3>
                        <p class="text-gray-300">Follow interesting people and discover new perspectives from around the world.</p>
                    </div>
                    
                    <div class="feature-card rounded-2xl p-8 text-center">
                        <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Stay Updated</h3>
                        <p class="text-gray-300">Get real-time updates on topics that interest you most.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 px-6 border-t border-gray-800">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl font-bold mb-6">Ready to join the conversation?</h2>
                <p class="text-xl text-gray-300 mb-8">Create your account and start chirping today.</p>
                @guest
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="btn-primary">
                            Sign up for free
                        </a>
                        <a href="{{ route('login') }}" class="btn-secondary">
                            Log in
                        </a>
                    </div>
                @else
                    <a href="{{ route('chirps.index') }}" class="btn-primary">
                        Go to your feed
                    </a>
                @endguest
            </div>
        </section>

        <!-- Footer -->
        <footer class="py-8 px-6 border-t border-gray-800">
            <div class="max-w-7xl mx-auto text-center">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <img src="{{ asset('chipmunk.svg') }}" alt="Chirper" class="w-6 h-6">
                    <span class="font-bold">Chirper</span>
                </div>
                <p class="text-gray-400">© 2025 Chirper. Built with Laravel and love.</p>
            </div>
        </footer>
    </body>
</html>
