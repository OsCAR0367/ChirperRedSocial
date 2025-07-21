<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('chirps.index') }}" class="p-2 hover-twitter-gray rounded-full">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-twitter-white">Edit Chirp</h1>
        </div>
    </x-slot>

    <div class="min-h-screen">
        <!-- Edit Chirp Form -->
        <div class="p-4">
            <form method="POST" action="{{ route('chirps.update', $chirp) }}" class="flex gap-3">
                @csrf
                @method('patch')
                
                <div class="avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                
                <div class="flex-1">
                    <textarea
                        name="message"
                        class="w-full bg-transparent text-xl placeholder-twitter-gray text-twitter-white border-none outline-none resize-none min-h-[120px] font-normal"
                        maxlength="280"
                        placeholder="What's happening?"
                    >{{ old('message', $chirp->message) }}</textarea>
                    
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    
                    <!-- Edit Actions -->
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-twitter-gray">
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
                                <span id="char-count">{{ strlen($chirp->message) }}</span>/280
                            </span>
                            <div class="flex gap-2">
                                <a href="{{ route('chirps.index') }}" 
                                   class="px-6 py-2 text-twitter-white font-bold border border-twitter-gray rounded-full hover-twitter-gray transition-colors duration-200">
                                    {{ __('Cancel') }}
                                </a>
                                <button type="submit" 
                                        class="btn-primary px-6 py-2 font-bold disabled:opacity-50" 
                                        id="update-btn">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Original Chirp Preview -->
        <div class="border-t border-twitter-gray mt-8 p-4">
            <div class="text-twitter-gray text-sm mb-3">Original chirp:</div>
            <article class="chirp-card p-4 bg-twitter-light-gray rounded-2xl">
                <div class="flex gap-3">
                    <div class="avatar">
                        {{ substr($chirp->user->name, 0, 1) }}
                    </div>
                    
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-bold text-twitter-white">{{ $chirp->user->name }}</span>
                            <span class="text-twitter-gray">@{{ Str::slug($chirp->user->name) }}</span>
                            <span class="text-twitter-gray">·</span>
                            <time class="text-twitter-gray">
                                {{ $chirp->created_at->diffForHumans() }}
                            </time>
                        </div>
                        
                        <div class="text-twitter-white whitespace-pre-wrap leading-normal">{{ $chirp->message }}</div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.querySelector('textarea[name="message"]');
            const charCount = document.getElementById('char-count');
            const updateBtn = document.getElementById('update-btn');
            
            textarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;
                
                if (count > 280) {
                    charCount.style.color = '#f91880';
                    updateBtn.disabled = true;
                } else if (count > 260) {
                    charCount.style.color = '#ffd400';
                    updateBtn.disabled = false;
                } else {
                    charCount.style.color = '#71767b';
                    updateBtn.disabled = count === 0;
                }
            });
            
            // Focus textarea on load
            textarea.focus();
            textarea.setSelectionRange(textarea.value.length, textarea.value.length);
        });
    </script>
</x-app-layout>