@extends('layouts.app')

@section('title')
    Perfil
@endsection

@section('content')

<main class="mt-15 flex-1 p-4 max-w-7xl mx-auto w-full">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center justify-center mb-10">
        <div class="w-full max-w-96 max-h-96 mx-auto lg:mx-0 lg:ml-auto">
            <img class="w-full h-full object-cover rounded-full"
                 src="{{ empty($user->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $user->image) }}" 
                 alt="Imagen usuario">
            
        </div>
        <div class="w-full flex flex-col items-center lg:items-start gap-3 justify-center">
            
            <div class="flex justify-center items-center gap-4">
                <p class="text-xl font-semibold text-gray-800">{{$user->username}}</p> 
                @auth
                    @if ($user->id === auth()->user()->id)
                        <a href="{{route('profile.edit', $user)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-500 hover:text-gray-800 transition-colors duration-300 ease-linear">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    @endif
                @endauth
            </div>
            
            <livewire:profile.profile-info :user="$user" />

            <livewire:followers.follow-button :user="$user" />
            
        </div>
    </div>

    <p class="text-center mb-8 font-semibold text-2xl">Publicaciones</p>

    <livewire:posts.profile-post :user="$user" />

</main>

@endsection