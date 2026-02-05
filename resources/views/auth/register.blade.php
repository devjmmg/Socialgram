@extends('layouts.app')

@section('title')
Regístrate en SocialGram
@endsection

@section('content')

<div class="lg:flex justify-center md:gap-10 md:items-center mt-12">
    <div class="lg:w-7/12 mb-4 lg:mb-0">
        <img class="rounded-lg" src="{{asset('img/register.avif')}}" alt="Imagen de registro">
    </div>
    <div class="lg:w-4/12 bg-white p-6 rounded-xl">
        <form action="{{route('register.store')}}" method="POST">

            @csrf

            <div class="mb-4">
                <label for="name" class="mb-2 block text-xl">Nombre: </label>
                <input 
                type="text"
                name="name"
                id="name"
                placeholder="Ej. Juan Manuel"
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('name') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                value="{{old('name')}}"
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
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('username') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                value="{{old('username')}}"
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
                class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('email') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
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
            value="Crear cuenta"
            class="text-blue-500 border border-solid w-full border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3 cursor-pointer"
            >

        </form>
    </div>
</div>

@endsection