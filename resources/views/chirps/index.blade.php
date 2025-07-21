<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h1 class="text-xl font-bold text-twitter-white">Home</h1>
        </div>
    </x-slot>

    <div class="min-h-screen">
        <!-- Compose Chirp Section -->
        <div class="border-b border-twitter-gray p-4">
            <form method="POST" action="{{ route('chirps.store') }}" class="flex gap-3">
                @csrf
                <div class="avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1">
                    <textarea
                        name="message"
                        placeholder="{{ __('What\'s happening?') }}"
                        class="w-full bg-transparent text-xl placeholder-twitter-gray text-twitter-white border-none outline-none resize-none min-h-[120px] font-normal"
                        maxlength="280"
                    >{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    
                    <!-- Compose Actions -->
                    <div class="flex items-center justify-between mt-3 pt-3">
                        <div class="flex items-center space-x-4 text-twitter-blue">
                            <!-- Media options (icons only for now) -->
                            <button type="button" class="p-2 hover-twitter-blue rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button type="button" class="p-2 hover-twitter-blue rounded-full">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.736 6.979C9.208 6.193 9.696 6 10 6c.304 0 .792.193 1.264.979a1 1 0 001.715-1.029C12.279 4.784 11.232 4 10 4s-2.279.784-2.979 1.95c-.285.475-.507 1-.67 1.55H6a1 1 0 000 2h.013a9.358 9.358 0 000 1H6a1 1 0 100 2h.351c.163.55.385 1.075.67 1.55C7.721 15.216 8.768 16 10 16s2.279-.784 2.979-1.95a1 1 0 10-1.715-1.029C10.792 13.807 10.304 14 10 14c-.304 0-.792-.193-1.264-.979a4.265 4.265 0 01-.264-.521H10a1 1 0 100-2H8.472a7.396 7.396 0 010-1H10a1 1 0 100-2H8.472c.08-.185.167-.36.264-.521z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-twitter-gray">
                                <span id="char-count">0</span>/280
                            </span>
                            <button type="submit" class="btn-primary px-6 py-2 font-bold disabled:opacity-50" disabled id="chirp-btn">
                                {{ __('Chirp') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Chirps Feed -->
        <div class="divide-y divide-twitter-gray">
            @foreach ($chirps as $chirp)
                <article class="chirp-card p-4 cursor-pointer">
                    <div class="flex gap-3">
                        <!-- User Avatar -->
                        <div class="avatar">
                            {{ substr($chirp->user->name, 0, 1) }}
                        </div>
                        
                        <!-- Chirp Content -->
                        <div class="flex-1 min-w-0">
                            <!-- User Info and Time -->
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-bold text-twitter-white hover:underline">{{ $chirp->user->name }}</span>
                                <span class="text-twitter-gray">·</span>
                                <time class="text-twitter-gray hover:underline">
                                    {{ $chirp->created_at->diffForHumans() }}
                                </time>
                                @unless ($chirp->created_at->eq($chirp->updated_at))
                                    <span class="text-twitter-gray">· {{ __('edited') }}</span>
                                @endunless
                            </div>
                            
                            <!-- Chirp Text -->
                            <div class="text-twitter-white mb-3 whitespace-pre-wrap leading-normal">{{ $chirp->message }}</div>
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between max-w-md">
                                <!-- Reply/Comments -->
                                <div x-data="{ showComments: false }" class="flex flex-col">
                                    <button @click="showComments = !showComments" class="flex items-center gap-2 text-twitter-gray hover:text-twitter-blue group">
                                        <div class="p-2 rounded-full group-hover:bg-blue-900 group-hover:bg-opacity-20">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.867-.04v1.93l5.764-3.19c1.77-.97 2.866-2.8 2.866-4.81 0-2.97-2.43-5.39-5.412-5.39h-4.218z"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm">{{ $chirp->comments_count }}</span>
                                    </button>
                                    
                                    <!-- Comments Section -->
                                    <div x-show="showComments" x-transition class="mt-4 border-t border-twitter-gray pt-4" style="display: none;">
                                        <!-- Add Comment Form -->
                                        <form action="{{ route('chirps.comment', $chirp) }}" method="POST" class="mb-4">
                                            @csrf
                                            <div class="flex gap-3">
                                                <div class="avatar">
                                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                </div>
                                                <div class="flex-1">
                                                    <textarea name="comment" placeholder="Add a comment..." 
                                                            class="w-full bg-transparent text-xl placeholder-twitter-gray border-none resize-none focus:outline-none"
                                                            rows="2" maxlength="280"></textarea>
                                                    <div class="flex justify-between items-center mt-3">
                                                        <span class="text-sm text-twitter-gray">280 characters remaining</span>
                                                        <button type="submit" class="btn-primary px-6 py-2">Comment</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                        <!-- Comments List -->
                                        @foreach($chirp->comments as $comment)
                                            <div class="flex gap-3 mb-3 pb-3 border-b border-gray-800 last:border-b-0">
                                                <div class="avatar">
                                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                </div>
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-2 mb-1">
                                                        <span class="font-semibold">{{ $comment->user->name }}</span>
                                                        <span class="text-twitter-gray text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                                        @if($comment->user->is(auth()->user()))
                                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ml-auto">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-500 hover:text-red-400 text-sm"
                                                                        onclick="return confirm('Delete this comment?')">Delete</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <p class="text-twitter-white">{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Share/Retweet -->
                                <form action="{{ route('chirps.share', $chirp) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 text-twitter-gray hover:text-green-500 group {{ $chirp->isSharedBy(auth()->user()) ? 'text-green-500' : '' }}">
                                        <div class="p-2 rounded-full group-hover:bg-green-900 group-hover:bg-opacity-20">
                                            <img src="{{ asset('share.svg') }}" alt="Share" class="w-5 h-5 {{ $chirp->isSharedBy(auth()->user()) ? 'filter-green' : '' }}">
                                        </div>
                                        <span class="text-sm">{{ $chirp->shares_count }}</span>
                                    </button>
                                </form>
                                
                                <!-- Like -->
                                <form action="{{ route('chirps.like', $chirp) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 text-twitter-gray hover:text-red-500 group {{ $chirp->isLikedBy(auth()->user()) ? 'text-red-500' : '' }}">
                                        <div class="p-2 rounded-full group-hover:bg-red-900 group-hover:bg-opacity-20">
                                            <img src="{{ asset('like.svg') }}" alt="Like" class="w-5 h-5 {{ $chirp->isLikedBy(auth()->user()) ? 'filter-red' : '' }}">
                                        </div>
                                        <span class="text-sm">{{ $chirp->likes_count }}</span>
                                    </button>
                                </form>
                                
                                <!-- More Options -->
                                @if ($chirp->user->is(auth()->user()))
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="text-twitter-gray hover:text-twitter-blue p-2 rounded-full hover:bg-blue-900 hover:bg-opacity-20">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        
                                        <div x-show="open" @click.outside="open = false" 
                                             class="absolute right-0 mt-2 w-48 bg-twitter-dark border border-twitter-gray rounded-xl shadow-xl py-2 z-10"
                                             style="display: none;">
                                            <a href="{{ route('chirps.edit', $chirp) }}" 
                                               class="block px-4 py-3 text-sm hover-twitter-gray transition-colors duration-200">
                                                {{ __('Edit Chirp') }}
                                            </a>
                                            <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this chirp?')"
                                                        class="block w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-900 hover:bg-opacity-20 transition-colors duration-200">
                                                    {{ __('Delete Chirp') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    <script>
        // Character counter and button state
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea[name="message"]');
            const charCount = document.getElementById('char-count');
            const chirpBtn = document.getElementById('chirp-btn');
            
            textarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;
                
                if (count > 280) {
                    charCount.style.color = '#f91880';
                    chirpBtn.disabled = true;
                } else if (count > 260) {
                    charCount.style.color = '#ffd400';
                    chirpBtn.disabled = false;
                } else {
                    charCount.style.color = '#71767b';
                    chirpBtn.disabled = count === 0;
                }
            });
        });
    </script>
</x-app-layout>