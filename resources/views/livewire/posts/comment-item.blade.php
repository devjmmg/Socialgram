<div class="flex items-center justify-between mt-1">
    <div class="flex items-center gap-2">
        <button class="text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear font-semibold">
            Comentar
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
    @auth
        <button wire:click="toggleLike({{ $comment->id }})">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $comment->checkLike(auth()->user()) ? 'red' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
    @endauth
</div>