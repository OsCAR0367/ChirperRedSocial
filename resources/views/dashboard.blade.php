<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h1 class="text-xl font-bold text-twitter-white">Home</h1>
        </div>
    </x-slot>

    <div class="min-h-screen">
        <!-- Welcome Section -->
        <div class="p-6 border-b border-twitter-gray">
            <div class="flex items-center gap-4 mb-6">
                <div class="avatar text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-twitter-white">Welcome back, {{ Auth::user()->name }}!</h2>
                    <p class="text-twitter-gray">Ready to share what's on your mind?</p>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('chirps.index') }}" 
                   class="flex items-center gap-4 p-6 bg-twitter-gray hover:bg-twitter-light-gray rounded-2xl transition-colors duration-200 group">
                    <div class="p-3 bg-twitter-blue rounded-full group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-twitter-white mb-1">View Chirps</h3>
                        <p class="text-twitter-gray text-sm">See what everyone is talking about</p>
                    </div>
                    <svg class="w-5 h-5 text-twitter-gray group-hover:text-twitter-white ml-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                
                <a href="{{ route('profile.edit') }}" 
                   class="flex items-center gap-4 p-6 bg-twitter-gray hover:bg-twitter-light-gray rounded-2xl transition-colors duration-200 group">
                    <div class="p-3 bg-green-600 rounded-full group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-twitter-white mb-1">Edit Profile</h3>
                        <p class="text-twitter-gray text-sm">Update your account settings</p>
                    </div>
                    <svg class="w-5 h-5 text-twitter-gray group-hover:text-twitter-white ml-auto" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="p-6">
            <h3 class="text-xl font-bold text-twitter-white mb-4">Recent Activity</h3>
            <div class="space-y-4">
                <div class="flex items-center gap-3 p-4 bg-twitter-gray rounded-xl">
                    <div class="p-2 bg-twitter-blue rounded-full">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-twitter-white font-medium">Account created successfully</p>
                        <p class="text-twitter-gray text-sm">Welcome to Chirper! Start sharing your thoughts.</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 p-4 bg-twitter-gray rounded-xl">
                    <div class="p-2 bg-purple-600 rounded-full">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-twitter-white font-medium">Profile setup complete</p>
                        <p class="text-twitter-gray text-sm">Your profile is ready to go!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="p-6 border-t border-twitter-gray">
            <h3 class="text-xl font-bold text-twitter-white mb-4">Your Stats</h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-twitter-gray rounded-xl">
                    <div class="text-2xl font-bold text-twitter-white">0</div>
                    <div class="text-twitter-gray text-sm">Chirps</div>
                </div>
                <div class="text-center p-4 bg-twitter-gray rounded-xl">
                    <div class="text-2xl font-bold text-twitter-white">0</div>
                    <div class="text-twitter-gray text-sm">Following</div>
                </div>
                <div class="text-center p-4 bg-twitter-gray rounded-xl">
                    <div class="text-2xl font-bold text-twitter-white">0</div>
                    <div class="text-twitter-gray text-sm">Followers</div>
                </div>
                <div class="text-center p-4 bg-twitter-gray rounded-xl">
                    <div class="text-2xl font-bold text-twitter-white">0</div>
                    <div class="text-twitter-gray text-sm">Likes</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
