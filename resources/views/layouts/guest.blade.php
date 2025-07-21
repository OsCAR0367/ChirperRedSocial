<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Chirper') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
                background-color: #000000;
                color: #e7e9ea;
            }
            
            .auth-card {
                background-color: #000000;
                border: 1px solid #2f3336;
                border-radius: 16px;
            }
            
            .form-input {
                background-color: transparent;
                border: 1px solid #2f3336;
                border-radius: 4px;
                color: #e7e9ea;
                padding: 16px;
                font-size: 17px;
                transition: border-color 0.2s ease;
            }
            
            .form-input:focus {
                border-color: #1d9bf0;
                outline: none;
                box-shadow: 0 0 0 2px rgba(29, 155, 240, 0.2);
            }
            
            .form-input::placeholder {
                color: #71767b;
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
                width: 100%;
            }
            
            .btn-primary:hover {
                background-color: #1a8cd8;
            }
            
            .btn-primary:disabled {
                background-color: #536471;
                cursor: not-allowed;
            }
            
            .link-primary {
                color: #1d9bf0;
                text-decoration: none;
                transition: color 0.2s ease;
            }
            
            .link-primary:hover {
                color: #1a8cd8;
                text-decoration: underline;
            }
            
            .error-text {
                color: #f91880;
                font-size: 14px;
                margin-top: 8px;
            }
        </style>
    </head>
    <body class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-3">
                    <img src="{{ asset('chipmunk.svg') }}" alt="Chirper" class="w-12 h-12">
                    <span class="text-3xl font-bold">Chirper</span>
                </a>
            </div>

            <!-- Auth Card -->
            <div class="auth-card p-8">
                {{ $slot }}
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-gray-500 text-sm">
                    © 2025 Chirper. Made with ❤️ using Laravel.
                </p>
            </div>
        </div>
    </body>
</html>
