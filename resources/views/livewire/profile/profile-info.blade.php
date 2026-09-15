<div class="flex flex-col gap-1">

    @if ($showUsers)

        <div
            x-data
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4"
        >
            <div
                @click.outside="$wire.closeUsers()"
                @keydown.escape.window="$wire.closeUsers()"
                class="w-full max-w-md bg-white rounded-md shadow-lg"
            >

                <div class="flex items-center justify-between border-b border-gray-200 px-4 py-3">

                    <h2 class="font-semibold text-gray-800">
                        {{ $showUsers === 'followers' ? 'Seguidores' : 'Siguiendo' }}
                    </h2>

                    <button
                        wire:click="closeUsers"
                        type="button"
                        class="text-gray-500 hover:text-gray-700 transition-colors duration-200"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </button>

                </div>

                <div class="max-h-96 overflow-y-auto p-4">

                    @forelse ($users as $user)

                        <a
                            href="{{ route('posts.index', $user->username) }}"
                            class="flex items-center gap-3 py-2 hover:bg-gray-50 rounded-md transition-colors duration-200"
                        >

                            <img
                                class="w-10 h-10 rounded-full object-cover"
                                src="{{ empty($user->image)
                                    ? asset('storage/defaults/user.svg')
                                    : asset('storage/profile/' . $user->image) }}"
                                alt="Imagen de {{ $user->username }}"
                            >

                            <div>
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ $user->username }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $user->name }}
                                </p>
                            </div>

                        </a>

                    @empty

                        <p class="text-sm text-gray-500 text-center py-8">
                            No hay usuarios para mostrar.
                        </p>

                    @endforelse

                </div>

            </div>
        </div>

    @endif

    @auth

        @if (auth()->id() === $user->id)

            <button
                wire:click="showFollowers"
                type="button"
                class="text-left text-lg text-gray-800 font-semibold hover:text-blue-500 transition-colors duration-200"
            >
                {{ $followers }}
                <span class="font-normal">
                    @choice('Seguidor|Seguidores', $followers)
                </span>
            </button>

        @else

            <p class="text-lg text-gray-800 font-semibold">
                {{ $followers }}
                <span class="font-normal">
                    @choice('Seguidor|Seguidores', $followers)
                </span>
            </p>

        @endif

    @else

        <p class="text-lg text-gray-800 font-semibold">
            {{ $followers }}
            <span class="font-normal">
                @choice('Seguidor|Seguidores', $followers)
            </span>
        </p>

    @endauth

    @auth

        @if (auth()->id() === $user->id)

            <button
                wire:click="showFollowing"
                type="button"
                class="text-left text-lg text-gray-800 font-semibold hover:text-blue-500 transition-colors duration-200"
            >
                {{ $following }}
                <span class="font-normal">Siguiendo</span>
            </button>

        @else

            <p class="text-lg text-gray-800 font-semibold">
                {{ $following }}
                <span class="font-normal">Siguiendo</span>
            </p>

        @endif

    @else

        <p class="text-lg text-gray-800 font-semibold">
            {{ $following }}
            <span class="font-normal">Siguiendo</span>
        </p>

    @endauth


    <p class="text-lg text-gray-800 font-semibold">
        {{ $total }}
        <span class="font-normal">Post</span>
    </p>

</div>