@extends('layouts.app')

@section('title')
{{$post->title}}
@endsection

@section('content')

<div class="flex flex-col gap-8 md:flex-row">
    
    <div class="md:w-1/2 flex flex-col gap-4 justify-center">
        <img class="rounded-lg" src="{{asset('uploads/'.$post->image)}}" alt="Imagen Post">
        
        <div class="flex flex-col px-4 md:px-0 gap-2 xl:flex-row xl:gap-0 xl:justify-between">
            
            <livewire:like-post :post="$post" />
            
            <p class="font-semibold"> <a href="{{route('posts.index', $user)}}">{{$post->user->username}}</a> | <span class="text-gray-500 text-sm">{{$post->created_at->diffForHumans()}}</span></p>
        </div>
        
        <p class="px-4 md:px-0">{{$post->description}}</p>
        
        @auth
        
        @if ($post->user_id === auth()->user()->id)
        <form action="{{route('posts.destroy',$post)}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit"
            class="bg-red-500 text-white p-4 rounded-lg cursor-pointer font-semibold hover:bg-red-600 transition-colors ease-in duration-300"
            value="Eliminar publicación"
            >
        </form>
        @endif
        
        @endauth
    </div>
    
    <div class="md:w-1/2">
        
        <div class="bg-white p-4 rounded-lg">
            
            
            @guest
            <p class="font-semibold text-xl text-center">Inicia sesión para agregar un comentarío</p>
            @endguest
            
            @auth
            <p class="font-semibold text-xl text-center mb-8">Agrega un nuevo comentario</p>
            @endauth
            
            @if (session('mensaje'))
            <p class="bg-green-500 p-2 text-center mt-2 rounded-lg text-white font-bold mb-2"> {{ session('mensaje') }} </p>
            @endif
            
            @foreach ($post->comments as $comment)
            <div class="flex flex-col gap-2 mb-4 border-b">
                
                <div class="lg:flex lg:items-center lg:gap-2">
                    
                    <a href="{{route('posts.index',$comment->user)}}" class="font-semibold"> {{$comment->user->username}} </a> <span class="text-gray-500 text-sm">{{$comment->created_at->diffForHumans()}}</span>
                    
                </div>
                
                <p class="mb-2">{{$comment->comment}}</p>
                
            </div>
            @endforeach
            
            @auth
            
            <form action="{{route('comments.store',['user' => $user, 'post' => $post])}}" method="POST">
                
                @csrf
                
                <div class="mb-4">
                    <textarea 
                    name="comment" 
                    id="comment"
                    rows="3"
                    placeholder="Genial, yo estoy aprendiendo AWS visita mi perfíl para..."
                    class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('comment') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4"
                    ></textarea>
                    
                    @error('comment')
                    <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                    @enderror
                </div>
                
                <input 
                type="submit"
                value="Comentar"
                class="text-blue-500 border border-solid w-full border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3 cursor-pointer"
                >
                
            </form>
            
            @endauth
            
        </div>
        
    </div>
    
</div>

@endsection