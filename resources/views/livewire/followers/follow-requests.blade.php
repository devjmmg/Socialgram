<div>
    <div class="p-4 flex flex-col gap-4">
        @forelse ($pendingFollowers as $item)
            <div class="
                p-4
                border border-gray-200
                hover:bg-gray-100
                transition-colors duration-300 ease-linear
                rounded-md
                flex flex-col gap-4
                sm:flex-row sm:items-center sm:justify-between
            ">

                <a
                    href="{{ route('posts.index', $item->username) }}"
                    class="flex items-center gap-3 min-w-0"
                >
                    <img
                        class="size-11 rounded-full object-cover shrink-0"
                        src="{{ empty($item->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $item->image) }}"
                        alt="Imagen usuario"
                    >

                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 sm:whitespace-normal sm:overflow-visible sm:text-clip truncate">
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
                        class="w-full md:w-auto text-xs bg-blue-500 hover:bg-blue-600 transition-colors ease-linear duration-300 text-white p-2 md:px-3 md:py-2 rounded"
                    >
                        Aceptar
                    </button>

                    <button
                        wire:click="reject({{ $item->id }})"
                        class="w-full md:w-auto text-xs text-gray-500 hover:text-gray-600 transition-colors ease-linear duration-300 border border-gray-300 p-2 md:px-3 md:py-2 rounded"
                    >
                        Rechazar
                    </button>

                </div>

            </div>
        @empty
            <p class="p-4 text-sm text-gray-500 text-center">
                No hay solicitudes.
            </p>
        @endforelse
    </div>
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