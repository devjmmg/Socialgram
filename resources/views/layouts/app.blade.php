<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scrollbar-thin">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml" sizes="any">
    <title>Socialgram @hasSection ('title') - @yield('title') @endif</title>
    @stack('style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col">
    <header class="fixed top-0 w-full z-30 bg-white p-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a 
                href="{{route('home.index')}} " 
                class="text-xl font-semibold text-blue-500 ">
                    Socialgram
            </a>
            <div
                x-data="{ open: false }"
                x-effect="document.documentElement.style.overflow = open ? 'hidden' : ''"
                x-init="
                    const mq = window.matchMedia('(min-width: 768px)');
                    const handleResize = () => {
                        if (mq.matches) {
                            open = false;
                        }
                    };
                    window.addEventListener('resize', handleResize);
                "
            >
                <button
                    @click="open = true"
                    class="md:hidden cursor-pointer text-black flex items-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-7"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5"
                        />
                    </svg>
                </button>
                <div
                    class="fixed inset-0 z-30 bg-black"
                    x-show="open"
                    x-transition:enter="transition ease-linear duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-linear duration-300"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-4"
                    x-cloak
                >
                    <div class="p-4 flex justify-between">
                        <a 
                            href="{{route('home.index')}} " 
                            class="text-xl font-semibold text-blue-500 ">
                                Socialgram
                        </a>
                        <button
                            @click="open = false"
                            class="md:hidden cursor-pointer text-white flex items-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-7"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18 18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                    @guest
                        <nav class="flex flex-col">
                            <a class="text-center text-sm font-medium {{ Route::is('login') ? 'bg-blue-500' : '' }} text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear" href="{{route('login')}}">
                                Iniciar sesión
                            </a>
                            <a class="text-center text-sm font-medium {{ Route::is('register') ? 'bg-blue-500' : '' }} text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear" href="{{route('register')}}">
                                Crear cuenta
                            </a>
                        </nav>
                    @endguest
                    @auth
                        <nav class="flex flex-col">
                            <a
                                href="{{route('home.index')}}"
                                class="text-center text-sm font-medium text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear"
                            >
                                Inicio
                            </a>
                            <a
                                href="{{route('friends.index')}}"
                                class="text-center text-sm font-medium text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear"
                            >
                                Buscar
                            </a>
                            <a
                                href="#"
                                class="text-center text-sm font-medium text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear"
                            >
                                Notificaciones
                            </a>
                            <a
                                href="{{ route('followers.index') }}"
                                class="text-center text-sm font-medium text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear"
                            >
                                Solicitudes
                            </a>
                            <a
                                href="{{route('posts.create')}}"
                                class="text-center text-sm font-medium text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear"
                            >
                                Publicar
                            </a>
                            <div
                                x-data="{ dropdown: false }"
                                @click.outside="dropdown = false"
                                @keydown.escape.window="dropdown = false"
                                @resize.window="dropdown = false"
                                class="relative"
                            >
                                <button
                                    @click="dropdown = !dropdown"
                                    class="w-full flex items-center justify-center gap-2 text-sm font-medium text-white p-4 hover:bg-blue-500 transition-colors duration-300 ease-linear"
                                >
                                    {{ auth()->user()->name }}

                                    <svg
                                        :class="dropdown ? 'rotate-180' : ''"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-4 transition-transform duration-300"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m19.5 8.25-7.5 7.5-7.5-7.5"
                                        />
                                    </svg>
                                </button>
                                <div
                                    x-cloak
                                    x-show="dropdown"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 -translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 -translate-y-2"
                                    class="absolute left-0 right-0 bg-gray-900 border-t border-gray-800"
                                >
                                    <a
                                        href="{{ route('posts.index', auth()->user()->username) }}"
                                        class="block text-center text-sm text-white p-4 hover:bg-blue-500 transition-colors"
                                    >
                                        Perfil
                                    </a>

                                    <a
                                        href="{{ route('profile.edit', auth()->user()->username) }}"
                                        class="block text-center text-sm text-white p-4 hover:bg-blue-500 transition-colors"
                                    >
                                        Configuración
                                    </a>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf

                                        <input
                                            type="submit"
                                            value="Salir"
                                            class="w-full text-center text-sm text-white p-4 hover:bg-blue-500 transition-colors cursor-pointer"
                                        >
                                    </form>
                                </div>
                            </div>
                        </nav>
                    @endauth
                </div>
            </div>

            @guest
                <nav class="hidden md:flex gap-4 items-center">
                    <a class="text-sm font-medium {{ Route::is('login') ? 'text-blue-500' : 'text-gray-500' }} hover:text-blue-500 transition-colors duration-300 ease-linear" href="{{route('login')}}">
                        Iniciar sesión
                    </a>
                    <a class="text-sm font-medium {{ Route::is('register') ? 'text-blue-500' : 'text-gray-500' }} hover:text-blue-500 transition-colors duration-300 ease-linear" href="{{route('register')}}">
                        Crear cuenta
                    </a>
                </nav>
            @endguest

            @auth
                <nav class="hidden md:flex gap-4 justify-center items-center">
                    
                    <a href="{{route('home.index')}}" class="text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>
                    </a>

                    <livewire:user-search-modal />
                    
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
                                <div class="">
                                    <a class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-100" href="#">Link 1</a>
                                    <a class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-100" href="#">Link 2</a>
                                    <a class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-100" href="#">Link 3</a>
                                    <a class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-100" href="#">Link 4</a>
                                    <a class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-100" href="#">Link 5</a>
                                </div>
                            </div>
                        </div>
                        <p class="absolute w-5 h-5 rounded bg-blue-500 flex justify-center items-center text-white text-xs -top-3 left-3">
                            0
                        </p>
                    </div>

                    <livewire:followers.follow-requests-modal />

                    <a
                        class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear"
                        href="{{route('posts.create')}}"
                    />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <div
                        x-data="{ open: false }"
                        @click.outside="open = false"
                        @keydown.escape.window="open = false"
                        @resize.window="open = false"
                        class="relative"
                    >
                        <button
                            @click="open = !open"
                            class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear focus:outline-none flex gap-2 items-center justify-center"
                        >

                            {{ auth()->user()->username }}

                            <svg
                                :class="open ? 'rotate-180' : ''"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-4 transition-transform duration-300"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m19.5 8.25-7.5 7.5-7.5-7.5"
                                />
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
                            class="absolute right-0 mt-2 w-40 rounded-md border border-gray-200 bg-white shadow"
                        >
                            <a
                                href="{{route('posts.index', auth()->user()->username)}}"
                                class="block rounded-t-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 transition"
                            >
                                Perfil
                            </a>

                            <a
                                href="{{route('profile.edit', auth()->user()->username)}}"
                                class="block px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 transition"
                            >
                                Configuración
                            </a>
                            <form action="{{route('logout')}}" method="POST" class="w-full">
                                @csrf  
                                <input
                                    type="submit"
                                    value="Salir"
                                    class="block rounded-b-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 transition w-full text-left cursor-pointer"
                                />
                            </form>
                        </div>
                    </div>
                </nav>
            @endauth
        </div>
    </header>

    @yield('content')

    <footer class="text-center text-sm p-4">
        Socialgram - Todos los derechos reservados &copy; {{date('Y')}}
    </footer>

    @livewireScripts
</body>
</html>
