<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scrollbar-thin">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon.svg" type="image/svg+xml" sizes="any">
    <title>Socialgram @hasSection ('title') - @yield('title') @endif</title>
    @stack('style')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
    <header class="fixed top-0 w-full z-10 bg-white/95 backdrop-blur p-4 shadow">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a 
                href=" {{route('home.index')}} " 
                class="text-xl font-semibold text-blue-500 ">
                    Socialgram
            </a>
            <div id="inputMenu" class="md:hidden cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
                </svg>
            </div>

            @auth
                <nav class="hidden md:flex gap-4 justify-center items-center">
                    
                    <a href="{{route('home.index')}}" class="text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>
                    </a>

                    <button id="btnOpenModalFriend" class="text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-data="{ open: false }"
                        @click.outside="open = false"
                        @keydown.escape.window="open = false"
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
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                            class="absolute mt-2 w-60 rounded-lg border border-gray-200 bg-white shadow"
                        >
                            Notificaciones
                        </div>
                    </div>

                    <div
                        x-data="{ open: false }"
                        @click.outside="open = false"
                        @keydown.escape.window="open = false"
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
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                            class="absolute mt-2 w-60 rounded-lg border border-gray-200 bg-white shadow"
                        >
                            Solicitudes
                        </div>
                    </div>

                    <a
                        class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear"
                        href="{{route('posts.create')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                            <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                            <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    <div
                        x-data="{ open: false }"
                        @click.outside="open = false"
                        @keydown.escape.window="open = false"
                        class="relative"
                    >
                        <button
                            @click="open = !open"
                            class="text-sm text-gray-500 hover:text-blue-500 transition-colors duration-300 ease-linear focus:outline-none"
                        >
                            {{ auth()->user()->name }}
                        </button>
                        <div
                            x-cloak
                            x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-1 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-1 scale-95"
                            class="absolute mt-2 w-40 rounded-lg border border-gray-200 bg-white shadow"
                        >
                            <a
                                href="{{route('posts.index', auth()->user()->username)}}"
                                class="block rounded px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 transition"
                            >
                                Perfil
                            </a>

                            <a
                                href="{{route('profile.edit', auth()->user()->username)}}"
                                class="block rounded px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 transition"
                            >
                                Configuración
                            </a>
                            <form action="{{route('logout')}}" method="POST" class="w-full">
                                @csrf  
                                <input
                                    type="submit"
                                    value="Salir"
                                    class="block rounded px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 transition w-full text-left cursor-pointer"
                                />
                            </form>
                        </div>
                    </div>
                </nav>
            @endauth

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

        </div>
    </header>

    @yield('history')

    @yield('content')

    <footer class="text-center text-sm p-4">
        Socialgram - Todos los derechos reservados &copy; {{date('Y')}}
    </footer>

    <div id="modalFriend" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center transition-all duration-500 ease-in-out -top-[100rem] opacity-0 pointer-events-none z-20">
        <div class="bg-white rounded-lg w-full md:max-w-2xl lg:max-w-3xl m-1 md:m-0 overflow-auto h-[95vh] scrollbar-none">
            <div class="p-6 g-blue-500 flex items-center gap-4 border-b border-gray-300 sticky top-0 bg-white">
                <button id="btnCloseModalFriend" class="bg-black-500 text-blue-500 rounded-md p-2 transition-colors ease-in-out duration-500 hover:bg-blue-700 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg> 
                </button>
                <input 
                    class="w-full rounded-md p-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-700 bg-gray-100"
                    type="text" 
                    id="inputFriend" 
                    name="inputFriend"
                    placeholder="Buscar amigos..."
                />
            </div>
            <div class="my-4">
                <ul id="ulListResults" class="list-none text-center"></ul>
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>
