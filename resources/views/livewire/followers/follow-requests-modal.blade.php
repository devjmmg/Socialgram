<div
    x-data="{ open: false }"
    @click.outside="open = false"
    @keydown.escape.window="open = false"
    @resize.window="open = false"
    class="relative"
>
    <button
        @click="open = !open"
        class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear focus:outline-none flex items-center"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
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
            <h3 class="px-3 py-2 text-sm font-medium border-b border-gray-200 text-gray-700">Solicitudes</h3>
            @forelse ($pendingFollowers as $item)
                <div class="px-3 py-2 space-y-1 hover:bg-gray-100 transition-colors duration-300 ease-linear">
                    <a href="{{ route('posts.index', $item->username) }}" class="flex items-center gap-3">
                        <img
                            class="size-11 rounded-full object-cover"
                            src="{{ empty($item->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $item->image) }}"
                            alt="Imagen usuario"
                        >

                        <div>
                            <p class="text-sm font-medium text-gray-700 truncate max-w-48">
                                {{ $item->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                Quiere seguirte
                            </p>
                        </div>
                    </a>

                    <div class="flex items-center gap-2">

                        <button
                            wire:click="accept({{ $item->id }})"
                            class="w-full text-xs bg-blue-500 hover:bg-blue-600 transition-colors ease-linear duration-300 text-white p-2 rounded"
                        >
                            Aceptar
                        </button>

                        <button
                            wire:click="reject({{ $item->id }})"
                            class="w-full text-xs text-gray-500 hover:text-gray-600 transition-colors ease-linear duration-300 border border-gray-300 p-2 rounded"
                        >
                            Rechazar
                        </button>

                    </div>

                </div>
            @empty

                <p class="px-3 py-2 text-sm text-gray-500">
                    No hay solicitudes.
                </p>
            @endforelse
        </div>
        @if ($pendingFollowersTotal > 5)
            <div class="px-3 py-2 border-t border-gray-200">
                <a
                    href="{{route('followers.index')}}"
                    class="block text-center text-sm font-medium text-blue-500 hover:text-blue-600 transition-colors duration-300 ease-linear"
                >
                    Ver más solicitudes
                </a>
            </div>
        @endif
    </div>
    <p class="absolute w-5 h-5 rounded bg-blue-500 flex justify-center items-center text-white text-xs -top-3 left-3">
        {{ $pendingFollowersTotal }}
    </p>
</div>