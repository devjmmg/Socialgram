<div>
    <div class="sticky top-15 p-4 bg-white">
        <input
            type="text"
            name="search"
            wire:model.live.debounce.500ms="search"
            placeholder="Buscar"
            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none placeholder:text-gray-400 transition-colors duration-300 ease-linear"
        >
    </div>
    <div class="p-4 flex flex-col gap-4">
        @forelse ($users as $user)
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
                    href="{{ route('posts.index', $user->username) }}"
                    class="flex items-center gap-3 w-full"
                >
                    <img
                        class="size-11 rounded-full object-cover shrink-0"
                        src="{{ empty($user->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $user->image) }}"
                        alt="Imagen usuario"
                    >

                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-700 sm:whitespace-normal sm:overflow-visible sm:text-clip truncate">
                            {{ $user->name }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ $user->username }}
                        </p>
                    </div>
                </a>

                @if ($user->id !== auth()->user()->id)
                    <div class="flex gap-2">

                        @php
                            $follow = $user->follow(auth()->user());
                        @endphp

                        @if (!$follow)

                            <button
                                wire:click="follow({{ $user }})"
                                class="w-full md:w-auto text-xs bg-blue-500 hover:bg-blue-600 transition-colors ease-linear duration-300 text-white p-2 md:px-3 md:py-2 rounded"
                            >
                                Seguir
                            </button>

                        @else

                            <button
                                wire:click="unfollow({{ $user }})"
                                class="w-full md:w-auto text-xs text-gray-500 hover:text-gray-600 transition-colors ease-linear duration-300 border border-gray-300 p-2 md:px-3 md:py-2 rounded"
                            >
                                {{ $follow->pivot->status === 'pending' ? 'Pendiente' : 'Siguiendo' }}
                            </button>
                        @endif
                    </div>
                @endif

            </div>
        @empty
            @if (strlen($search) >= 3)
                <p class="mt-4 text-center text-sm text-gray-500">
                    No se encontraron usuarios.
                </p>
            @endif
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