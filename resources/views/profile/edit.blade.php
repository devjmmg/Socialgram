@extends('layouts.app')

@section('content')

<main class="mt-15 max-w-7xl mx-auto w-full p-4 xl:p-0">

    <div class="border border-gray-300 my-15 rounded-md p-4">

        <h2 class="font-semibold text-gray-800 text-lg mb-10">Información del perfil</h2>

        @if (session('profile_success'))
            <p class="text-green-500 text-sm mb-4"> {{ session('profile_success') }} </p>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 items-center justify-center">

            <form action="{{route('profile.update',$user)}}" method="POST" enctype="multipart/form-data" >
                @csrf

                <div class="mb-4">
                    <label for="name" class="mb-1 block text-sm font-medium text-gray-800">Nombre: </label>
                    <input 
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Ej. Juan Manuel"
                        class="border border-gray-300 focus:outline-none focus:border-blue-500 
                               @error('name') border-red-500 focus:border-red-500 @enderror 
                               rounded-md block px-3 py-2.5 transition-colors duration-300 ease-linear w-full"
                        value="{{ $user->name }}"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="mb-1 block text-sm font-medium text-gray-800">Nombre de usuario: </label>
                    <input 
                        type="text"
                        name="username"
                        id="username"
                        placeholder="Ej. devjmmg"
                        class="border border-gray-300 focus:outline-none focus:border-blue-500 
                               @error('username') border-red-500 focus:border-red-500 @enderror 
                               rounded-md block px-3 py-2.5 transition-colors duration-300 ease-linear w-full"
                        value="{{ $user->username }}"
                    >
                    @error('username')
                        <p class="text-red-500 text-sm mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="mb-1 block text-sm font-medium text-gray-800">Correo electrónico: </label>
                    <input 
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Ej. devjmmg@correo.com"
                        class="border border-gray-300 focus:outline-none focus:border-blue-500 
                               @error('email') border-red-500 focus:border-red-500 @enderror 
                               rounded-md block px-3 py-2.5 transition-colors duration-300 ease-linear w-full"
                        value="{{ $user->email }}"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1"> {{ $message }} </p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="mb-1 block text-sm font-medium text-gray-800">Imagen: </label>
                    <input 
                        type="file"
                        name="image"
                        id="image"
                        class="
                            w-full
                            block
                            rounded-md
                            border border-gray-300
                            transition-colors duration-300 ease-linear
                            focus:outline-none
                            focus:border-blue-500

                            file:mr-3
                            file:px-4
                            file:py-2.5
                            file:border-0
                            file:border-r
                            file:border-gray-200
                            file:bg-gray-50
                            file:text-gray-500
                            file:font-medium
                            file:cursor-pointer
                            file:text-sm

                            hover:file:bg-gray-100

                            @error('image')
                                border-red-500 focus:border-red-500
                            @enderror
                        "
                        accept=".jpg,.png,.jpeg,.avif,.webp"
                    />
                </div>

                <div class="mb-4">
                    <input 
                        type="submit"
                        value="Guardar"
                        class="w-full rounded-md border border-blue-500 p-2.5 text-blue-500 hover:bg-blue-900 text-base font-medium
                            hover:text-white transition duration-300 ease-in cursor-pointer"
                    >
                </div>

            </form>

            <div class="w-96 h-96 mx-auto">
                <img
                    class="w-full h-full object-cover rounded-full"
                    src="{{ empty($user->image) ? asset('img/usuario.svg') : asset('profiles/'.$user->image) }}"
                    alt="Imagen usuario"
                >
            </div>

        </div>

    </div>

    <div class="border border-gray-300 my-15 rounded-md p-4">

        <h2 class="font-semibold text-gray-800 text-lg mb-10">Cambiar contraseña</h2>

        @if (session('password_success'))
            <p class="text-green-500 text-sm mb-4"> {{ session('password_success') }} </p>
        @endif

        <form action="{{route('password.update',$user)}}" method="POST">
                
                @csrf
                
                <div class="mb-4">
                    <label for="password_current" class="mb-1 block text-sm font-medium text-gray-800">Contraseña actual: </label>
                    <input 
                        type="password"
                        name="password_current"
                        id="password_current"
                        placeholder="********"
                        class="border border-gray-300 focus:outline-none focus:border-blue-500 
                               @error('password_current') border-red-500 focus:border-red-500 @enderror 
                               rounded-md block px-3 py-2.5 transition-colors duration-300 ease-linear w-full lg:w-1/2"
                    >
                    @error('password_current')
                        <p class="text-red-500 text-sm mt-1"> {{ $message }} </p>
                    @enderror

                    @if (session('password'))
                        <p class="text-red-500 text-sm mt-1"> {{ session('password') }} </p>
                    @endif
                </div>
                
                <div class="mb-4">
                    <label for="password" class="mb-1 block text-sm font-medium text-gray-800">Nueva contraseña: </label>
                    <input 
                        type="password"
                        name="password"
                        id="password"
                        placeholder="********"
                        class="border border-gray-300 focus:outline-none focus:border-blue-500 
                               @error('password') border-red-500 focus:border-red-500 @enderror 
                               rounded-md block px-3 py-2.5 transition-colors duration-300 ease-linear w-full lg:w-1/2"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="mb-1 block text-sm font-medium text-gray-800">Confirmar contraseña: </label>
                    <input 
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="********"
                        class="border border-gray-300 focus:outline-none focus:border-blue-500 
                               @error('password_confirmation') border-red-500 focus:border-red-500 @enderror 
                               rounded-md block px-3 py-2.5 transition-colors duration-300 ease-linear w-full lg:w-1/2"
                    >
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1"> {{ $message }} </p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <input 
                        type="submit"
                        value="Guardar"
                        class="w-full lg:w-1/2 rounded-md border border-blue-500 p-2.5 text-blue-500 hover:bg-blue-900 text-base font-medium
                            hover:text-white transition duration-300 ease-in cursor-pointer"
                    >
                </div>
                
            </form>

    </div>

</main>

@endsection