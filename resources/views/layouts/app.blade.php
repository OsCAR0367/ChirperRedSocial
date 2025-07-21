<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Chirper') }}</title>

        <!-- X.com Style Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* X.com inspired styling */
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
                background-color: #000000;
                color: #e7e9ea;
            }
            
            .bg-twitter-dark { background-color: #000000; }
            .bg-twitter-gray { background-color: #16181c; }
            .bg-twitter-light-gray { background-color: #1e2328; }
            .text-twitter-white { color: #e7e9ea; }
            .text-twitter-gray { color: #71767b; }
            .text-twitter-blue { color: #1d9bf0; }
            .border-twitter-gray { border-color: #2f3336; }
            .hover-twitter-gray:hover { background-color: rgba(255, 255, 255, 0.03); }
            .hover-twitter-blue:hover { background-color: rgba(29, 155, 240, 0.1); }
            
            .chirp-card {
                border-bottom: 1px solid #2f3336;
                transition: background-color 0.2s ease;
            }
            
            .chirp-card:hover {
                background-color: rgba(255, 255, 255, 0.03);
            }
            
            .avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: #1d9bf0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-weight: 600;
                flex-shrink: 0;
            }
            
            .btn-primary {
                background-color: #1d9bf0;
                color: white;
                border: none;
                border-radius: 9999px;
                font-weight: 700;
                transition: background-color 0.2s ease;
            }
            
            .btn-primary:hover {
                background-color: #1a8cd8;
            }
            
            .sidebar-nav {
                position: fixed;
                left: 0;
                top: 0;
                height: 100vh;
                width: 275px;
                background-color: #000000;
                padding: 0 16px;
                border-right: 1px solid #2f3336;
            }
            
            .main-content {
                margin-left: 275px;
                border-left: 1px solid #2f3336;
                border-right: 1px solid #2f3336;
                min-height: 100vh;
                max-width: 600px;
                background-color: #000000;
            }
            
            .right-sidebar {
                position: fixed;
                right: 0;
                top: 0;
                width: 350px;
                height: 100vh;
                background-color: #000000;
                padding: 0 16px;
            }
            
            @media (max-width: 1024px) {
                .sidebar-nav { width: 68px; }
                .main-content { margin-left: 68px; }
                .right-sidebar { display: none; }
            }
            
            @media (max-width: 768px) {
                .sidebar-nav { display: none; }
                .main-content { margin-left: 0; max-width: 100%; }
            }
        </style>
    </head>
    <body class="bg-twitter-dark text-twitter-white">
        <div class="min-h-screen">
            <!-- Sidebar Navigation -->
            <div class="sidebar-nav">
                @include('layouts.navigation')
            </div>

            <!-- Main Content Area -->
            <div class="main-content">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="sticky top-0 bg-twitter-dark bg-opacity-80 backdrop-blur-md border-b border-twitter-gray z-10">
                        <div class="px-4 py-3">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>

            <!-- Right Sidebar (hidden on mobile) -->
            <div class="right-sidebar hidden lg:block">
                <div class="pt-4">
                    <div class="bg-twitter-gray rounded-2xl p-4 mb-4">
                        <h3 class="text-xl font-bold mb-3">What's happening</h3>
                        <div class="space-y-3">
                            <div class="hover-twitter-gray p-2 rounded cursor-pointer">
                                <p class="text-twitter-gray text-sm">Trending in Technology</p>
                                <p class="font-semibold">#Laravel</p>
                                <p class="text-twitter-gray text-sm">42.1K Chirps</p>
                            </div>
                            <div class="hover-twitter-gray p-2 rounded cursor-pointer">
                                <p class="text-twitter-gray text-sm">Trending</p>
                                <p class="font-semibold">#WebDevelopment</p>
                                <p class="text-twitter-gray text-sm">28.5K Chirps</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
