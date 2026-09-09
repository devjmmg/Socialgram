<div>

    @if ($posts->isEmpty())

        <div class="py-12 text-center">
            <p class="text-sm font-medium text-gray-500">
                Aún no hay publicaciones de tus amigos
            </p>
            <p class="mt-1 text-xs text-gray-400">
                Cuando tus amigos publiquen algo, aparecerá aquí.
            </p>
        </div>

    @else

        <div class="max-w-xl mx-auto space-y-8">

            @foreach ($posts as $post)

                <article class="bg-white border border-gray-200 rounded-md overflow-hidden">

                    <div class="flex items-center gap-3 px-3 py-3">

                        <a href="{{ route('posts.index', $post->user->username) }}">

                            <img
                                class="w-10 h-10 rounded-full object-cover"
                                src="{{ empty($post->user->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $post->user->image) }}"
                                alt="Imagen de {{ $post->user->username }}"
                            >

                        </a>

                        <div class="flex flex-col">
                            <a
                                href="{{ route('posts.index', $post->user->username) }}"
                                class="font-semibold text-gray-800 hover:text-gray-600 transition-colors duration-200 text-sm"
                            >
                                {{ $post->user->username }}
                            </a>
                            <span class="text-sm">
                                <span class="text-xs">
                                    {{ str_replace('hace ', '', $post->created_at->diffForHumans()) }}
                                </span>
                            </span>
                        </div>

                    </div>

                    <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">

                        <img
                            loading="lazy"
                            class="w-full aspect-square object-cover cursor-pointer"
                            src="{{ asset('storage/uploads/' . $post->image) }}"
                            alt="Imagen Post"
                        >

                    </a>

                    <div class="flex items-center justify-evenly gap-5 p-2">

                        <button
                            wire:click="toogleLike({{ $post->id }})"
                            type="button"
                            class="border-none"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $post->checkLike(auth()->user()) ? 'red' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>

                        <a
                            href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                        </a>

                    </div>

                </article>

            @endforeach

            @if ($hasMore)
                <div
                    wire:intersect="loadMore"
                    class="p-4 text-center"
                >
                    <span
                        wire:loading.remove
                        wire:target="loadMore"
                        class="text-gray-500 text-sm"
                    >
                        Cargar más
                    </span>

                    <span
                        wire:loading
                        wire:target="loadMore"
                        class="text-gray-500 text-sm"
                    >
                        Cargando...
                    </span>
                </div>
            @endif

        </div>

    @endif

</div>