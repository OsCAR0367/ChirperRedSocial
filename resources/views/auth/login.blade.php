<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Sign in to Chirper</h1>
        <p class="text-gray-400">Welcome back! Please sign in to your account.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-2">
                {{ __('Email') }}
            </label>
            <input id="email" 
                   class="form-input w-full" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="Enter your email" />
            @error('email')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-white mb-2">
                {{ __('Password') }}
            </label>
            <input id="password" 
                   class="form-input w-full"
                   type="password"
                   name="password"
                   required 
                   autocomplete="current-password"
                   placeholder="Enter your password" />
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" 
                   type="checkbox" 
                   class="w-4 h-4 text-blue-600 bg-transparent border-gray-600 rounded focus:ring-blue-500 focus:ring-2" 
                   name="remember">
            <label for="remember_me" class="ml-2 text-sm text-gray-300">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary">
            {{ __('Sign in') }}
        </button>

        <!-- Links -->
        <div class="space-y-4 text-center">
            @if (Route::has('password.request'))
                <div>
                    <a class="link-primary text-sm" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                </div>
            @endif
            
            @if (Route::has('register'))
                <div class="pt-4 border-t border-gray-700">
                    <p class="text-gray-400 text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="link-primary font-medium">
                            Sign up for Chirper
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>
