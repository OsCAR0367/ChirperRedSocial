<nav class="flex flex-col h-full py-4" x-data="{ open: false }">
    <!-- Logo -->
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="flex items-center justify-center lg:justify-start p-3 hover-twitter-gray rounded-full transition-colors duration-200">
            <img src="{{ asset('chipmunk.svg') }}" alt="Chirper" class="w-8 h-8">
            <span class="hidden lg:block ml-4 text-xl font-bold">Chirper</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 space-y-2">
        <!-- Home -->
        <a href="{{ route('dashboard') }}" class="flex items-center p-3 hover-twitter-gray rounded-full transition-colors duration-200 {{ request()->routeIs('dashboard') ? 'font-bold' : '' }}">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            <span class="hidden lg:block ml-4 text-xl">Home</span>
        </a>

        <!-- Chirps -->
        <a href="{{ route('chirps.index') }}" class="flex items-center p-3 hover-twitter-gray rounded-full transition-colors duration-200 {{ request()->routeIs('chirps.*') ? 'font-bold' : '' }}">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <span class="hidden lg:block ml-4 text-xl">Chirps</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" class="flex items-center p-3 hover-twitter-gray rounded-full transition-colors duration-200 {{ request()->routeIs('profile.*') ? 'font-bold' : '' }}">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
            <span class="hidden lg:block ml-4 text-xl">Profile</span>
        </a>
    </div>

    <!-- User Menu -->
    <div class="mt-auto">
        <div class="relative">
            <button @click="open = ! open" class="flex items-center w-full p-3 hover-twitter-gray rounded-full transition-colors duration-200">
                <div class="avatar text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="hidden lg:block ml-3 flex-1 text-left">
                    <div class="font-semibold text-sm">{{ Auth::user()->name }}</div>
                    <div class="text-twitter-gray text-sm">@{{ Str::slug(Auth::user()->name) }}</div>
                </div>
                <svg class="hidden lg:block w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 @click.outside="open = false"
                 class="absolute bottom-full left-0 w-full mb-2 bg-twitter-dark border border-twitter-gray rounded-xl shadow-xl py-2"
                 style="display: none;">
                
                <a href="{{ route('profile.edit') }}" class="block w-full text-left px-4 py-3 text-sm hover-twitter-gray transition-colors duration-200">
                    {{ __('Profile Settings') }}
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-3 text-sm hover-twitter-gray transition-colors duration-200">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Bottom Navigation -->
<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-twitter-dark border-t border-twitter-gray z-50">
    <div class="flex justify-around py-2">
        <a href="{{ route('dashboard') }}" class="p-3 hover-twitter-gray rounded-full {{ request()->routeIs('dashboard') ? 'text-twitter-blue' : '' }}">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
        </a>
        <a href="{{ route('chirps.index') }}" class="p-3 hover-twitter-gray rounded-full {{ request()->routeIs('chirps.*') ? 'text-twitter-blue' : '' }}">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </a>
        <a href="{{ route('profile.edit') }}" class="p-3 hover-twitter-gray rounded-full {{ request()->routeIs('profile.*') ? 'text-twitter-blue' : '' }}">
            <div class="avatar text-xs">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </a>
    </div>
</div>
