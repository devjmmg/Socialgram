<div>
    @auth
        <div class="flex items-center justify-between mt-1">
            <div class="flex items-center gap-2">
                <button
                    wire:click="$dispatch('reply-to', { comment: {{ $comment->id }} })"
                    class="text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear font-semibold"
                >
                    Responder
                </button>
                @if ($comment->likes_count > 0)
                    <span class="flex items-center gap-1">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="red"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                            />
                        </svg>

                        {{ $comment->likes_count }}
                    </span>
                @endif
            </div>
            <button wire:click="toggleLike({{ $comment->id }})">
                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $comment->checkLike(auth()->user()) ? 'red' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
        </div>
    @endauth

    <div class="flex flex-col gap-3">
        @foreach ($comment->replies as $reply)
            <div id="comment-{{ $reply->id }}" class="flex items-start gap-4 py-2">
                <a href="{{ route('posts.index', $reply->user->username) }}">
                    <img
                        class="w-8 h-8 rounded-full object-cover"
                        src="{{ empty($reply->user->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $reply->user->image) }}"
                        alt="Imagen de {{ $reply->user->username }}"
                    >
                </a>
                <div class="flex-1">
                    <div class="text-sm">
                        <div class="flex items-center justify-between py-1">
                            <div class="flex items-center gap-2">
                                <a
                                    href="{{ route('posts.index', $reply->user->username) }}"
                                    class="font-semibold text-gray-800 hover:text-gray-600 transition-colors duration-300 ease-linear"
                                >
                                    {{ $reply->user->username }}
                                </a>
                                <span class="text-xs text-gray-400">
                                    {{ str_replace('hace ', '', $reply->created_at->diffForHumans()) }}
                                </span>
                            </div>
                            @auth

                                @if ($reply->post->user_id === auth()->id() || $reply->user_id === auth()->id())

                                    <div
                                        x-data="{ open: false }"
                                        class="relative flex items-center"
                                    >

                                        <button
                                            type="button"
                                            @click="open = !open"
                                            class="text-gray-500 hover:text-gray-700 transition-colors duration-200"
                                            
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                        </button>

                                        <div
                                            x-show="open"
                                            x-cloak
                                            @click.outside="open = false"
                                            @keydown.escape.window="open = false"
                                            x-transition
                                            class="absolute right-0 top-full mt-2 w-48 bg-white border border-gray-200 rounded shadow z-10"
                                        >
                                            <button
                                                @click="open = false"
                                                wire:click="destroy({{ $reply->id }})"
                                                type="button"
                                                class="w-full text-left px-3 py-2 text-red-500"
                                            >
                                                Eliminar comentario
                                            </button>

                                        </div>

                                    </div>

                                @endif

                            @endauth
                        </div>

                        <span class="text-gray-700 sm:whitespace-pre">{{ $reply->comment }}</span>

                        @auth
                            <div class="flex items-center justify-between mt-1">
                                <div class="flex items-center gap-2">
                                    
                                    @if ($reply->likes_count > 0)
                                        <span class="flex items-center gap-1">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="red"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="size-5"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
                                                />
                                            </svg>

                                            {{ $reply->likes_count }}

                                        </span>
                                    @endif
                                </div>
                                <button wire:click="toggleLike({{ $reply->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $reply->checkLike(auth()->user()) ? 'red' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>
                            </div>
                        @endauth
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>