<div>
    @auth
        @if ($hasPendingRequest)
            <div class="mt-15 p-4">
                <div class="max-w-7xl mx-auto md:flex md:items-center md:justify-center">

                    <div class="flex flex-col md:flex-row items-center gap-2 min-w-0">

                        <p class="text-sm font-medium text-gray-800 truncate">
                            {{ $user->username }}
                        </p>

                        <p class="text-sm text-gray-500 truncate">
                            quiere seguirte
                        </p>

                        <button
                            wire:click="accept({{ $user->id }})"
                            type="button"
                            class="w-full md:w-auto px-3 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 rounded-md transition-colors duration-300 ease-linear"
                        >
                            Aceptar
                        </button>

                        <button
                            wire:click="reject({{ $user->id }})"
                            type="button"
                            class="w-full md:w-auto px-3 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors duration-300 ease-linear"
                        >
                            Rechazar
                        </button>

                    </div>

                </div>
            </div>
        @endif
    @endauth
</div>
