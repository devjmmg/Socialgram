@extends('layouts.app')

@section('title')
    Compartir publicación
@endsection

@section('content')

    <main class="flex-1 mt-15 p-4 flex">

        <div class="max-w-7xl mx-auto w-full flex flex-col justify-center">

            <div class="grid gap-4">

                <div class="border border-gray-200 rounded-md bg-white p-4">

                    <div class="mb-4">

                        <h2 class="text-lg font-semibold text-gray-800">
                            Imagen
                        </h2>

                        <p class="text-sm text-gray-500">
                            Selecciona y ajusta la imagen que quieres compartir.
                        </p>

                    </div>

                    <div class="grid grid-cols-1 gap-4">

                        <div>

                            <div
                                id="dropzone"
                                class="
                                    m-0
                                    dropzone
                                    text-gray-500 hover:text-gray-600
                                    w-full h-100
                                    flex justify-center items-center
                                    border-2 border-dashed border-gray-300
                                    rounded-md
                                    cursor-pointer
                                    hover:border-blue-500 hover:bg-gray-50
                                    transition-colors duration-300 ease-linear
                                    @error('image')
                                        border-red-500
                                    @enderror
                                "
                            >

                            </div>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div
                                id="cropper-container"
                                class="w-full h-100 overflow-hidden"
                            >

                                <img
                                    id="cropper-image"
                                    class="block w-full h-100"
                                >

                            </div>

                        </div>

                    <div class="flex justify-end mt-3">

                        <button
                            id="cut"
                            type="button"
                            class="
                                w-full md:w-auto
                                px-4 py-2.5
                                text-sm font-semibold
                                text-white
                                bg-blue-500
                                border border-blue-500
                                rounded-md
                                hover:bg-blue-600
                                transition-colors duration-300
                                curssor-pointer opacity-50 cursor-not-allowed
                            "
                        >
                            Recortar
                        </button>

                    </div>

                    <div
                        id="crop-preview-container"
                        class="hidden mt-4"
                    >

                        <div class="mb-2">

                            <h2 class="text-lg font-semibold text-gray-800">
                                Vista previa
                            </h3>

                            <p class="text-sm text-gray-500">
                                Revisa cómo quedará la imagen antes de compartirla.
                            </p>

                        </div>

                        <div
                            class="
                                w-100
                                h-100
                                max-w-full
                                overflow-hidden
                                border border-gray-300
                            "
                        >

                            <img
                                id="crop-preview"
                                class="block w-full h-full object-contain"
                                alt="Preview del recorte"
                            >

                        </div>

                    </div>

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

                    <form
                        id="form-post"
                        action="{{ route('posts.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

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

                        <input class="hidden" type="file" id="inputImage" name="image">

                        <div class="flex justify-end">

                            <button
                                disabled
                                type="submit"
                                id='btnPost'
                                class="
                                    w-full md:w-auto
                                    px-4 py-2.5
                                    text-sm font-semibold
                                    text-white
                                    bg-blue-500
                                    border border-blue-500
                                    rounded-md
                                    hover:bg-blue-600
                                    transition-colors duration-300
                                    opacity-50 cursor-not-allowed
                                "
                            >
                                Compartir publicación
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

@endsection