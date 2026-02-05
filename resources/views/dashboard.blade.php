@extends('layouts.app')

@section('title')
Perfil
@endsection

@section('content')

<div class="flex flex-col items-center sm:flex-row md:justify-center gap-8 mb-8">
    <div class="w-full text-right relative">
        
        <img class="w-full inline-block lg:w-1/2 rounded-full" 
        src="{{ empty($user->image) ? asset('img/usuario.svg') : asset('profiles/'.$user->image) }}" 
        alt="Imagen usuario">
        
    </div>
    <div class="w-full flex flex-col items-center gap-4 sm:items-start justify-center">
        
        <div class="flex justify-center items-center gap-4">
            <p class="text-2xl text-gray-700">{{$user->username}}</p> 
            @auth
            @if ($user->id === auth()->user()->id)
            <a href="{{route('profile.edit', $user)}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </a>
            @endif
            @endauth
        </div>
        
        <p class="text-xl text-gray-700 font-bold">
            {{$followers}} 
            <span class="font-normal"> @choice('Seguidor|Seguidores', $followers) </span>
        </p>
        
        <p class="text-xl text-gray-700 font-bold">
            {{$following}} <span class="font-normal">Siguiendo</span>
        </p>
        
        <p class="text-xl text-gray-700 font-bold">
            {{$total}} <span class="font-normal">Post</span>
        </p>
        
        @auth
        @if ($user->id !== auth()->user()->id)
        
        @if (!$user->followedBy( auth()->user()))
        
        <form action="{{route('follow.store',$user)}}" method="POST">
            @csrf
            <input
            type="submit"
            class="cursor-pointer bg-blue-500 text-white px-4 py-1 font-semibold rounded-lg transition-colors duration-300 ease-out hover:bg-blue-700 min-w-44 text-center" 
            value="Seguir">
        </form>
        
        @else
        
        <form action="{{route('follow.destroy',$user)}}" method="POST">
            @csrf
            @method('DELETE')
            <input
            type="submit"
            class="cursor-pointer bg-red-500 text-white px-4 py-1 font-semibold rounded-lg transition-colors duration-300 ease-in-out hover:bg-red-700 min-w-44 text-center"
            value="Dejar de seguir">
        </form>
        
        @endif
        
        @endif
        @endauth
        
    </div>
</div>

<p class="text-center mb-8 font-bold text-3xl">Publicaciones</p>

@auth

    @if ($posts->isEmpty())

        @if ( $user->id === auth()->user()->id)
        <p class="text-center text-xl">Aún no hay publicaciones, comienza creando una: <a class="text-blue-500 font-semibold" href="{{route('posts.create')}}">Crear publicación</a></p>    
        @else
        <p class="text-center text-xl">Aún no hay publicaciones...</p>
        @endif

    @else

        @if ($user->id === auth()->user()->id || $user->followedBy(auth()->user()))
            
            <x-list-post :posts="$posts"/>

            <div class="mt-4">
                {{-- {{$posts->links()}} --}}
                {{ $posts->links('pagination::tailwind') }}
            </div>

        @else

            <p class="text-center text-xl font-medium text-gray-500 mt-3">
                Esta cuenta es privada
            </p>
            
        @endif

    @endif

@endauth

@guest
<p class="text-center text-xl font-semibold text-gray-500 mt-6">
    ¡
    <a href="{{route('register.index')}}" class="text-blue-500">
        Regístrate ahora
    </a>
    o
    <a href="{{route('login.index')}}" class="text-blue-500">
        Inicia sesión
    </a>
    y sigue a tus amigos para ver sus publicaciones!
</p>
@endguest

@endsection