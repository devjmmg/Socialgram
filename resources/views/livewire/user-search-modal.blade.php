<div
    x-data="{ open: false }"
    x-effect="document.documentElement.style.overflow = open ? 'hidden' : ''"
    @keydown.escape.window="
        open = false;
        Livewire.dispatch('reset-search');
    "
    @resize.window = "
        open = false;
        Livewire.dispatch('reset-search');
    "
>
    <button
        @click="open = true"
        class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear focus:outline-none flex items-center -translate-y-"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
        </svg>
    </button>
    <div
        x-cloak
        x-show="open"
        @click.self="
            open = false;
            Livewire.dispatch('reset-search');
        "
        x-transition:enter="transition-opacity duration-1000"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 bg-black/50 p-4"
    >
        <div
            class="h-full flex flex-col max-w-3xl mx-auto rounded-xl bg-white shadow-xl"
        >
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h2 class="text-md font-medium text-gray-800">
                    Buscar amigos
                </h2>

                <button
                    @click="
                        open = false
                        Livewire.dispatch('reset-search');
                    "
                    class="text-gray-500 hover:text-gray-800 transition-colors duration-300 ease-linear"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

            <div class="flex-1 min-h-0 flex flex-col p-4">

                <input
                    type="text"
                    name="search"
                    wire:model.live.debounce.500ms="search"
                    placeholder="Buscar"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 text-sm focus:border-blue-500 focus:outline-none placeholder:text-gray-400 transition-colors duration-300 ease-linear"
                >

                <div class="flex-1 mt-4 overflow-y-auto">
                    @forelse ($users as $user)
                        <div class="
                            p-3
                            hover:bg-gray-100
                            transition-colors duration-300 ease-linear
                            rounded-md
                            flex gap-3 items-center justify-between
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
                                <div>

                                    @php
                                        $follow = $user->follow(auth()->user());
                                    @endphp

                                    @if (!$follow)

                                        <button
                                            wire:click="follow({{ $user }})"
                                            class="text-xs bg-blue-500 hover:bg-blue-600 transition-colors ease-linear duration-300 text-white p-2 rounded"
                                        >
                                            Seguir
                                        </button>

                                    @else

                                        <button
                                            wire:click="unfollow({{ $user }})"
                                            class="text-xs text-gray-500 hover:text-gray-600 transition-colors ease-linear duration-300 border border-gray-300 p-2 rounded"
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
                    <div class="pt-4 border-t border-gray-200">
                        <a
                            href="{{route('friends.index', ['search' => $search])}}"
                            class="block text-center text-sm font-medium text-blue-500 hover:text-blue-600 transition-colors duration-300 ease-linear"
                        >
                            Ver más resultados
                        </a>
                    </div>
                @endif
            </div>

            {{-- 
                <div class="p-4 border-t border-gray-200">
                    Footer
                </div> 
            --}}
        </div>
    </div>
</div>