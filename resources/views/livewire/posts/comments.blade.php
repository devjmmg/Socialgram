<div>

    <div class="p-4 flex flex-col gap-3">

        @forelse ($comments as $comment)

            <div class="flex items-start gap-4">

                <a href="{{ route('posts.index', $comment->user->username) }}">
                    <img
                        class="w-8 h-8 rounded-full object-cover"
                        src="{{ empty($comment->user->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $comment->user->image) }}"
                        alt="Imagen de {{ $comment->user->username }}"
                    >
                </a>

                <div class="flex-1">

                    <div class="text-sm">
                        
                        <div class="flex items-center gap-2">
                            <a
                                href="{{ route('posts.index', $comment->user->username) }}"
                                class="font-semibold text-gray-800 hover:text-gray-600 transition-colors duration-300 ease-linear"
                            >
                                {{ $comment->user->username }}
                            </a>
                            <span class="text-xs text-gray-400">
                                {{ str_replace('hace ', '', $comment->created_at->diffForHumans()) }}
                            </span>
                        </div>

                        <span class="text-gray-700 whitespace-pre-line">{{ $comment->comment }}</span>

                    </div>

                </div>

            </div>

        @empty

            <p class="text-sm text-gray-500 text-center py-8">
                Aquí aparecerán los comentarios.
            </p>

        @endforelse
        @if ($hasMore)
            <div class="py-4 text-center">

                <button
                    wire:click="loadMore"
                    wire:loading.attr="disabled"
                    wire:target="loadMore"
                    class="text-sm font-medium text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear"
                >
                    <span wire:loading.remove wire:target="loadMore">
                        Cargar más comentarios
                    </span>

                    <span wire:loading wire:target="loadMore">
                        Cargando comentarios...
                    </span>
                </button>

            </div>
        @endif

    </div>

    @auth

        <div class="border-t border-gray-200 p-4">

            <div class="flex items-center gap-3">

                <textarea
                    id="comment"
                    wire:model="comment"
                    wire:keydown.enter.prevent="store"
                    name="comment"
                    rows="1"
                    placeholder="Agrega un comentario..."
                    class="flex-1 resize-none border border-gray-300 p-3 rounded-sm text-sm focus:outline-none focus:border-blue-500 transition-colors duration-300 ease-linear"
                ></textarea>

                <button
                    wire:click="store"
                    type="button"
                    class="text-gray-700 hover:text-gray-500 transition-colors duration-200"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 12 3.27 3.125A.75.75 0 0 1 4.3 2.25l16.4 9.75a.75.75 0 0 1 0 1.29L4.3 21.75a.75.75 0 0 1-1.03-.875L6 12Zm0 0h7.5"
                        />
                    </svg>

                </button>

            </div>

        </div>

    @else

        <div class="border-t border-gray-200 px-4 py-5">

            <p class="text-sm text-gray-500 text-center">
                Inicia sesión para agregar un comentario.
            </p>

        </div>

    @endauth
</div>
