@extends('layouts.app')

@section('title')
Inicia sesión en SocialGram
@endsection

@section('content')

<div class="lg:flex justify-center md:gap-10 md:items-center mt-12">
    <div class="lg:w-7/12 mb-4 lg:mb-0">
        <img class="rounded-lg" src="{{asset('img/login.avif')}}" alt="Imagen inicio de sesión">
    </div>
    <div class="lg:w-4/12 bg-white p-6 rounded-xl">
        
        @if (session('mensaje'))
        <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold mb-2"> {{ session('mensaje') }} </p>
        @endif
        
        <form action="{{route('login.store')}}" method="POST">
            
            @csrf
            
            <div class="mb-4">
                <label for="email" class="mb-2 block text-xl">Correo electrónico: </label>
                <input 
                type="text"
                name="email"
                id="email"
                placeholder="Ej. devjmmg@correo.com"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('email') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 placeholder:text-xl"
                value="{{old('email')}}"
                >
                @error('email')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="mb-2 block text-xl">Contraseña: </label>
                <input 
                type="password"
                name="password"
                id="password"
                placeholder="********"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('password') border-red-300 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                
                >
                @error('password')
                <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                @enderror
            </div>
            
            <div class="mb-4 flex items-center gap-4">
                <input type="checkbox" name="remember" id="remember"><label for="remember" class="text-lg">Mantener mi sesión abierta</label>
            </div>
            
            <input 
            type="submit"
            value="Iniciar sesión"
            class="text-blue-500 border border-solid w-full border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3 cursor-pointer"
            >

        </form>
    </div>
</div>

@endsection