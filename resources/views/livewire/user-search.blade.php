<div class="">

    <div class="sticky top-15 p-4 bg-white">
        <input
            type="text"
            name="search"
            wire:model.live.debounce.500ms="search"
            placeholder="Buscar"
            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none placeholder:text-gray-400 transition-colors duration-300 ease-linear"
        >
    </div>

    <div class="p-4 pt-0">
        @forelse ($users as $u)
            <a
                href="{{route('posts.index', $u->username)}}"
                class="flex items-center gap-3 rounded-lg p-3 hover:bg-gray-100 transition"
            >
                <div class="size-11 rounded-full overflow-hidden">
                    <img
                        class="w-full h-full object-cover"
                        src="{{ empty($u->image) ? asset('img/usuario.svg') : asset('profiles/'.$u->image) }}"
                        alt="Imagen usuario"
                    >
                </div>

                <div>
                    <p class="font-medium text-gray-800">
                        {{$u->name}}
                    </p>
                    <p class="text-sm text-gray-500">
                        {{$u->username}}
                    </p>
                </div>
            </a>
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