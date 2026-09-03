@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
    Compartir publicación
@endsection

@section('content')

<main class="flex-1 mt-15 p-4 flex">

    <div class="max-w-7xl mx-auto w-full flex flex-col justify-center">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="border border-gray-200 rounded-md bg-white p-4">

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Imagen
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Selecciona la imagen que quieres compartir.
                    </p>
                </div>

                <form
                    enctype="multipart/form-data"
                    action="{{ route('images.store') }}"
                    method="POST"
                    id="dropzone"
                    class="dropzone w-full h-96 flex justify-center items-center
                           border-2 border-dashed border-gray-300
                           rounded-md cursor-pointer
                           hover:border-blue-500 hover:bg-gray-50
                           transition-colors duration-300 ease-linear
                           @error('image')
                               border-red-500
                           @enderror"
                >
                    @csrf
                </form>

                @error('image')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="border border-gray-200 rounded-md bg-white p-4">

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">
                        Información
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Agrega los detalles de tu publicación.
                    </p>
                </div>

                <form action="{{ route('posts.store') }}" method="POST">

                    @csrf

                    <div class="mb-5">

                        <label
                            for="title"
                            class="mb-2 block text-sm font-medium text-gray-800"
                        >
                            Título
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            placeholder="Ej. Desarrollando en Laravel, React, Node.js, Express, JavaScript, TypeScript"
                            value="{{ old('title') }}"
                            class="
                                block w-full
                                px-3 py-2.5
                                text-sm
                                text-gray-800
                                bg-white
                                border border-gray-300
                                rounded-md
                                outline-none
                                transition-colors duration-300 ease-linear
                                placeholder:text-gray-500
                                focus:border-blue-500
                                focus:ring-blue-500
                                @error('title')
                                    border-red-500
                                    focus:border-red-500
                                    focus:ring-red-500
                                @enderror
                            "
                        >

                        @error('title')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mb-5">

                        <label
                            for="description"
                            class="mb-2 block text-sm font-medium text-gray-800"
                        >
                            Descripción
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="7"
                            placeholder="Cuéntanos algo sobre esta publicación..."
                            class="
                                block w-full
                                px-3 py-2.5
                                text-sm
                                text-gray-800
                                bg-white
                                border border-gray-300
                                rounded-md
                                outline-none
                                resize-none
                                transition-colors duration-300 ease-linear
                                placeholder:text-gray-500
                                focus:border-blue-500
                                focus:ring-blue-500
                                @error('description')
                                    border-red-500
                                    focus:border-red-500
                                    focus:ring-red-500
                                @enderror
                            "
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <input
                        type="hidden"
                        id="inputImage"
                        name="image"
                        value="{{ old('image') }}"
                    >

                    <button
                        type="submit"
                        class="
                            w-full
                            px-4 py-2.5
                            text-sm font-semibold
                            text-white
                            bg-blue-500
                            border border-blue-500
                            rounded-md
                            hover:bg-blue-600
                            transition-colors duration-300
                            cursor-pointer
                        "
                    >
                        Compartir publicación
                    </button>

                </form>

            </div>

        </div>

    </div>

</main>

@endsection