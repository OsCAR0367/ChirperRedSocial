<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-white mb-2">Join Chirper today</h1>
        <p class="text-gray-400">Create your account and start chirping!</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-white mb-2">
                {{ __('Full Name') }}
            </label>
            <input id="name" 
                   class="form-input w-full" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Enter your full name" />
            @error('name')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

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
                   autocomplete="new-password"
                   placeholder="Create a password" />
            @error('password')
                <div class="error-text">{{ $message }}</div>
            @enderror
            <p class="text-xs text-gray-400 mt-1">Must be at least 8 characters long</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">
                {{ __('Confirm Password') }}
            </label>
            <input id="password_confirmation" 
                   class="form-input w-full"
                   type="password"
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Confirm your password" />
            @error('password_confirmation')
                <div class="error-text">{{ $message }}</div>
            @enderror
        </div>

        <!-- Terms and Privacy -->
        <div class="text-xs text-gray-400">
            By signing up, you agree to our 
            <a href="#" class="link-primary">Terms of Service</a> and 
            <a href="#" class="link-primary">Privacy Policy</a>.
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-primary">
            {{ __('Create account') }}
        </button>

        <!-- Links -->
        <div class="text-center pt-4 border-t border-gray-700">
            <p class="text-gray-400 text-sm">
                Already have an account? 
                <a href="{{ route('login') }}" class="link-primary font-medium">
                    Sign in
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
