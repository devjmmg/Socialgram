<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scrollbar-thin">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title> @hasSection('title') @yield('title') @else SocialGram @endif</title>
    
    @stack('style')
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    
</head>

<body class="bg-gray-50">
    
    <header class="p-5 border-b bg-white shadow-md md:sticky md:top-0 md:inset-x-0 md:z-10">
        <div class="container mx-auto flex justify-between items-center">
            <a 
            href="/" 
            class="text-3xl md:text-5xl font-bold text-blue-500 ">SocialGram
        </a>
        
        <div id="inputMenu" class="xl:hidden hover:cursor-pointer">
            <div class="w-10 bg-black mb-2 h-1"></div>
            <div class="w-10 bg-black mb-2 h-1"></div>
            <div class="w-10 bg-black h-1"></div>
        </div>
        
        @auth
        <nav class="hidden xl:flex gap-3 justify-center items-center">
            
            <button title="Buscar amigo" id="btnOpenModalFriend" class="flex gap-2 text-blue-500 border border-solid border-blue-500 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl p-3 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
            
            <a href="/" class="flex flex-col justify-center">
                <p class="text-lg font-semibold">Inicio</p>
            </a>
            
            |
            
            <div class="relative">
                <button id="notification" class="hover:scale-110 duration-300 ease-in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>
                
                <!-- Ventana de notificaciones -->
                <div id="notificationFollowers" class="absolute bg-white shadow-lg border rounded-lg w-96 max-h-96 mt-2 hidden opacity-0 translate-y-5 transition-all duration-500 ease-in-out">
                    <div class="border-b-2">
                        <h3 class="text-xl font-semibold m-3">Notificaciones</h3>
                    </div>
                    <ul id="notificationList" class="mt-4">
                        
                    </ul>
                </div>
            </div>
            
            |
            
            <div class="relative">
                <button id="friendRequests" class="hover:scale-110 duration-300 ease-in">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg> 
                </button>
                
                <!-- Ventana de notificaciones -->
                <div id="notificationFriendRequests" class="absolute bg-white shadow-lg border rounded-lg w-96 max-h-96 mt-2 hidden opacity-0 translate-y-5 transition-all duration-500 ease-in-out">
                    <div class="border-b-2">
                        <h3 class="text-xl font-semibold m-3">Solicitudes</h3>
                    </div>
                    <ul id="friendRequestsList" class="mt-4">
                        
                    </ul>
                </div>
            </div>
            
            |
            
            <a href="{{route('posts.index',auth()->user()->username)}}" class="flex flex-col justify-center">
                <p class="text-lg font-semibold">Hola: <span class="font-normal"> {{auth()->user()->name}} </span></p>
            </a>
            
            <a
            title="Publicar"
            class="flex gap-2 text-blue-500 border border-solid border-blue-500 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl p-3 cursor-pointer"
            href="{{route('posts.create')}}">
            
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
            </svg>
        </a>
        
        <form action="{{route('logout.store')}}" method="POST">
            @csrf  
            <button 
            title="Salir"
            type="submit"
            value="Cerrar sesión"
            class="text-blue-500 border border-solid border-blue-500 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl p-3 cursor-pointer"
            >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
        </button>
    </form>
</nav>
@endauth

@guest
<nav class="hidden xl:flex gap-4 items-center">
    <a class="text-blue-500 border border-solid border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3" href="{{route('login.index')}}">
        Iniciar sesión
    </a>
    
    <a class="text-blue-500 border border-solid border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3" href="{{route('register.index')}}">
        Crear cuenta
    </a>
</nav>
@endguest

</div>

</header>

@yield('history')

<main class="container mx-auto">
    
    @hasSection ('title')
    <h2 class="text-center font-bold text-4xl my-8 px-4">@yield('title')</h2>
    @endif
    
    @yield('content')
    
</main>

<footer class="text-center mt-10 p-4 text-xl">
    SocialGram - Todos los derechos reservados &copy; {{date('Y')}}
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
            placeholder="Buscar amigos...">
        </div>
        <div class="my-4">
            <ul id="ulListResults" class="list-none text-center">
            </ul>
        </div>
    </div>
</div>

@livewireScripts
</body>
</html>
