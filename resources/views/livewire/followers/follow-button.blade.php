
    <div>
        @auth
            @if ($user->id !== auth()->user()->id)
                @php
                    $follow = $user->follow(auth()->user());
                @endphp

                @if (!$follow)

                    <button
                        wire:click="follow({{ $user }})"
                        class=" bg-blue-500 hover:bg-blue-600 transition-colors ease-linear duration-300 text-white px-3 py-2 w-44 rounded"
                    >
                        Seguir
                    </button>

                @else

                    <button
                        wire:click="unfollow({{ $user }})"
                        class=" text-gray-500 hover:text-gray-600 transition-colors ease-linear duration-300 border border-gray-300 px-3 py-2 w-44 rounded"
                    >
                        {{ $follow->pivot->status === 'pending' ? 'Pendiente' : 'Siguiendo' }}
                    </button>
                @endif
            @endif
        @endauth
    </div>
