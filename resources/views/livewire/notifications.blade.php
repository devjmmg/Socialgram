<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    @resize.window="open = false"
    class="relative"
>
    <button
        @click="
            open = !open
            if (open) {
                $wire.markAllAsRead();
            }
        "
        class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear focus:outline-none flex items-center"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
        </svg>
    </button>
    <div
        x-cloak
        x-show="open"
        x-transition:enter="transition ease-linear duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
        class="absolute mt-2 w-72 overflow-hidden rounded-md border border-gray-200 bg-white shadow right-0"
    >
        <div>
            <h3 class="px-3 py-2 text-sm font-medium border-b border-gray-200 text-gray-700">Notificaciones</h3>
            @forelse ($notifications as $notification)
                @php
                    $user = $users[$notification->data['user_id']];
                @endphp
                <div class="px-3 py-2 space-y-1 hover:bg-gray-100 transition-colors duration-300 ease-linear text-sm">
                    @switch($notification->data['type'])
                        @case('like')
                                @php
                                    $post = $posts[$notification->data['post_id']];
                                @endphp

                                <a
                                    href="{{ route('posts.show', ['user' => auth()->user(), 'post' => $post]) }}"
                                    class="flex items-center gap-3"
                                >
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-700">
                                            <strong>{{ $user->username }}</strong>
                                            <span class="text-gray-500">le dio me gusta a tu publicación</span>
                                        </p>
                                    </div>

                                    <img src="{{ asset('storage/uploads/' . $post->image) }}" alt="Publicación" class="w-10 h-10 rounded object-cover shrink-0" />
                                </a>
                            @break

                        @case('like_comment')
                                @php
                                    $comment = $comments[$notification->data['comment_id']];
                                @endphp
                                
                                <a
                                    href="{{ route('posts.show', ['user' => auth()->user(), 'post' => $comment->post->id]) }}"
                                    onclick="sessionStorage.setItem('notification_comment', '{{ $comment->id }}')"
                                    class="flex items-center gap-3"
                                >
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-700">
                                            <strong>{{ $user->username }}</strong>
                                            <span class="text-gray-500">le dio me gusta a tu comentario</span>
                                        </p>

                                        <p class="text-gray-500 truncate">
                                            "{{ $comment->comment }}"
                                        </p>
                                    </div>

                                    <img
                                        src="{{ asset('storage/uploads/' . $comment->post->image) }}"
                                        alt="Publicación"
                                        class="w-10 h-10 rounded object-cover shrink-0"
                                    />
                                </a>
                            @break

                        @case('comment')

                            @break

                        @case('follow')

                            @break

                        @default
                            
                    @endswitch
                </div>
            @empty
                <p class="px-3 py-2 text-sm text-gray-500">
                    No hay notificaciones.
                </p>
            @endforelse
            @if ($hasMoreNotifications)
                <div class="px-3 py-2 border-t border-gray-200">
                    <a
                        href=""
                        class="block text-center text-sm font-medium text-blue-500 hover:text-blue-600 transition-colors duration-300 ease-linear"
                    >
                        Ver más notificaciones
                    </a>
                </div>
            @endif
        </div>
    </div>
    @if ($unreadCount > 0)
        <p class="absolute w-5 h-5 rounded bg-blue-500 flex justify-center items-center text-white text-xs -top-3 left-3">
            {{ $unreadCount }}
        </p>
    @endif
</div>