@extends('layouts.app')

@section('title')
Editar perfil
@endsection

@section('content')

<div class="flex justify-center">
    
    <div class="w-1/2 bg-white p-8 rounded-lg">
        
        <form action="{{route('profile.update',$user)}}" method="POST" enctype="multipart/form-data">
            
            @csrf
            
            <div class="mb-4">
                <label for="name" class="mb-2 block text-xl">Nombre: </label>
                <input 
                type="text"
                name="name"
                id="name"
                placeholder="Ej. Juan Manuel"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('name') border-red-500 focus:border-red-500 @enderror rounded-lg w-full p-4 text-xl placeholder:text-xl"
                value="{{ $user->name }}"
                >
                @error('name')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="username" class="mb-2 block text-xl">Nombre de usuario: </label>
                <input 
                type="text"
                name="username"
                id="username"
                placeholder="Ej. devjmmg"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('username') border-red-500 focus:border-red-500 @enderror rounded-lg w-full p-4 text-xl placeholder:text-xl"
                value="{{ $user->username }}"
                >
                @error('username')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="mb-2 block text-xl">Correo electrónico: </label>
                <input 
                type="text"
                name="email"
                id="email"
                placeholder="Ej. devjmmg@correo.com"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('email') border-red-500 focus:border-red-500 @enderror rounded-lg w-full p-4 text-xl placeholder:text-xl"
                value="{{ $user->email }}"
                >
                @error('email')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="image" class="mb-2 block text-xl">Imagen: </label>
                <input 
                type="file"
                name="image"
                id="image"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 rounded-lg w-full p-4 text-xl placeholder:text-xl"
                accept=".jpg, .png, .gif, .jpeg"
                >
            </div>
            
            <input 
            type="submit"
            value="Guardar cambios"
            class="text-blue-500 border border-solid w-full border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3 cursor-pointer"
            >
            
        </form>
        
    </div>
    
</div>

<h2 class="mt-20 mb-8 text-center font-bold text-3xl">Cambiar contraseña</h2>

<div class="flex justify-center">
    
    <div class="w-1/2 bg-white p-8 rounded-lg">
        
        @if (session('success'))
        <p class="bg-green-500 p-2 text-center mt-2 rounded-lg text-white font-bold mb-4"> {{ session('success') }} </p>
        @endif
        
        <form action="{{route('password.update',$user)}}" method="POST" enctype="multipart/form-data">
            
            @csrf
            
            <div class="mb-4">
                <label for="password_current" class="mb-2 block text-xl">Contraseña actual: </label>
                <input 
                type="password"
                name="password_current"
                id="password_current"
                placeholder="********"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('password_current') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                
                >
                @error('password_current')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
                @if (session('password'))
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ session('password') }} </p>
                @endif
            </div>
            
            <div class="mb-4">
                <label for="password" class="mb-2 block text-xl">Nueva contraseña: </label>
                <input 
                type="password"
                name="password"
                id="password"
                placeholder="********"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('password') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                
                >
                @error('password')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="mb-2 block text-xl">Confirmar contraseña: </label>
                <input 
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="********"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('password_confirmation') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                >
                @error('password_confirmation')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            
            <input 
            type="submit"
            value="Guardar cambios"
            class="text-blue-500 border border-solid w-full border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3 cursor-pointer"
            >
            
        </form>
        
    </div>
    
</div>

@endsection