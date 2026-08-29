@extends('layouts.app')

@section('title')
Iniciar sesión
@endsection

@section('content')

<main class="max-w-7xl mx-auto flex-1 lg:flex lg:justify-center lg:items-center mt-15">

    <div class="grid grid-cols-1 lg:grid-cols-2">

        <div class="">
            <img
                class="block h-full w-full object-contain"
                src="{{ asset('img/login.avif') }}"
                alt="Imagen inicio de sesión"
            >
        </div>

        <div class="flex flex-col justify-center p-6">
            
            <div class="w-full max-w-lg mx-auto">

                <h2 class="text-base text-gray-500 text-center mb-8">
                    Ingresa tus credenciales para iniciar sesión
                </h2>

                @if (session('mensaje'))
                    <p class="text-red-500 text-center mb-4">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <form action="{{ route('login') }}" method="POST">

                    @csrf

                    <div class="mb-5">
                        <label
                            for="email"
                            class="mb-1 block text-sm font-medium text-gray-800"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            placeholder="Ej. correo@correo.com"
                            class="border border-gray-300 focus:outline-none focus:border-blue-500 
                                   @error('email') border-red-500 focus:border-red-500 @enderror 
                                   rounded-md block w-full px-3 py-2.5 transition-colors duration-300 ease-linear"
                            value="{{ old('email') }}"
                        />

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label
                            for="password"
                            class="mb-1 block text-sm font-medium text-gray-800"
                        >
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="********"
                            class="border border-gray-300 focus:outline-none focus:border-blue-500
                                   @error('password') border-red-500 focus:border-red-500 @enderror
                                   rounded-md block w-full px-3 py-2.5 transition-colors duration-300 ease-linear"
                        />

                        @error('password')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-5 flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <label
                            for="remember"
                            class="text-sm text-gray-800"
                        >
                            Mantener mi sesión abierta
                        </label>
                    </div>

                    <input
                        type="submit"
                        value="Iniciar sesión"
                        class="w-full rounded-md border border-blue-500 p-2.5 text-blue-500 font-medium hover:bg-blue-900 
                             hover:text-white transition duration-300 ease-in cursor-pointer"
                    >

                </form>

            </div>

        </div>

    </div>

</main>

@endsection
