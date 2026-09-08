<div>

    @auth

        @php
            $follow = $user->follow(auth()->user());
        @endphp

        @if ($user->id === auth()->user()->id || ($follow && $follow->pivot->status === 'accepted'))

            @if ($posts->isEmpty())

                @if ($user->id === auth()->user()->id)

                    <p class="text-center text-gray-700 text-lg">
                        Aún no hay publicaciones, comienza creando una:
                        <a
                            class="text-blue-500 hover:text-blue-600 transition-colors duration-300 ease-linear font-medium"
                            href="{{ route('posts.create') }}"
                        >
                            Crear publicación
                        </a>
                    </p>

                @else

                    <p class="text-center text-gray-700 text-lg">
                        Aún no hay publicaciones.
                    </p>

                @endif

            @else

                 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8">
                    @foreach($posts as $post)
                        <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
                            <img loading="lazy" class="w-full max-w-96 aspect-square object-cover rounded-md md:hover:scale-105 md:transition md:ease-linear md:duration-300 cursor-pointer mx-auto" src="{{ asset('storage/uploads/' . $post->image) }}" alt="Imagen Post">
                        </a>
                    @endforeach
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

            @endif

        @else

            <p class="text-center text-lg font-medium text-gray-500 mt-3">
                Esta cuenta es privada
            </p>

        @endif

    @endauth

    @guest
        <p class="mt-6 text-center text-lg font-semibold text-gray-500">
            ¡<a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-600 transition-colors duration-300 ease-linear">Regístrate ahora</a>
            o
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600 transition-colors duration-300 ease-linear">
                Inicia sesión
            </a>
            y sigue a tus amigos para ver sus publicaciones!
        </p>
    @endguest

</div>
