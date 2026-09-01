@extends('layouts.app')

@section('title')
Crear cuenta
@endsection

@section('content')

<main class="max-w-7xl mx-auto flex-1 lg:flex lg:justify-center lg:items-center mt-15">

    <div class="grid grid-cols-1 lg:grid-cols-2">

        <div class="">
            <img
                class="block h-full w-full object-contain"
                src="{{ asset('img/register.avif') }}"
                alt="Imagen de registro"
            >
        </div>

        <div class="flex flex-col justify-center p-4">

            <div class="w-full max-w-lg mx-auto">

                <h2 class="text-base text-gray-500 text-center mb-8">
                    Crea tu cuenta para comenzar
                </h2>

                <form action="{{ route('register.store') }}" method="POST">

                    @csrf

                    <div class="mb-5">
                        <label
                            for="name"
                            class="mb-1 block text-sm font-medium text-gray-800"
                        >
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Ej. Pedro"
                            class="border border-gray-300 focus:outline-none focus:border-blue-500
                                   @error('name') border-red-500 focus:border-red-500 @enderror
                                   rounded-md block w-full px-3 py-2.5 transition-colors duration-300 ease-linear"
                            value="{{ old('name') }}"
                        />

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label
                            for="username"
                            class="mb-1 block text-sm font-medium text-gray-800"
                        >
                            Nombre de usuario
                        </label>

                        <input
                            type="text"
                            name="username"
                            id="username"
                            placeholder="Ej. pedrito21"
                            class="border border-gray-300 focus:outline-none focus:border-blue-500
                                   @error('username') border-red-500 focus:border-red-500 @enderror
                                   rounded-md block w-full px-3 py-2.5 transition-colors duration-300 ease-linear"
                            value="{{ old('username') }}"
                        />

                        @error('username')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

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

                    <div class="mb-5">
                        <label
                            for="password_confirmation"
                            class="mb-1 block text-sm font-medium text-gray-800"
                        >
                            Confirmar contraseña
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            placeholder="********"
                            class="border border-gray-300 focus:outline-none focus:border-blue-500
                                   @error('password_confirmation') border-red-500 focus:border-red-500 @enderror
                                   rounded-md block w-full px-3 py-2.5 transition-colors duration-300 ease-linear"
                        />

                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <input
                        type="submit"
                        value="Crear cuenta"
                        class="w-full rounded-md border border-blue-500 p-2.5 text-blue-500 font-medium 
                             hover:bg-blue-900 hover:text-white transition duration-300 ease-in cursor-pointer"
                    >

                </form>

            </div>

        </div>

    </div>

</main>

@endsection
