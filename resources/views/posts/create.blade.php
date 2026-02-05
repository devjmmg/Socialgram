@extends('layouts.app')

@push('style')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('title')
Crear nueva publicación
@endsection

@section('content')

<div class="flex flex-col gap-4 md:flex-row items-center">
    <div class="md:w-1/2 w-full">
        <form enctype="multipart/form-data" action="{{route('images.store')}}" method="POST" id="dropzone" class="dropzone border-2 w-full rounded-lg h-96 flex justify-center items-center cursor-pointer border-2 border-solid border-blue-300 @error('image') border-red-500 focus:border-red-500 @enderror">

            @csrf
        </form>
        @error('image')
        <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
        @enderror
    </div>
    <div class="md:w-1/2 w-full">
        <div class=" bg-white p-10 rounded-xl shadow">
            <form action="{{route('posts.store')}}" method="POST">
                
                @csrf
                
                <div class="mb-4">
                    <label for="title" class="mb-2 block text-xl">Título: </label>
                    <input 
                    type="text"
                    name="title"
                    id="title"
                    placeholder="Ej. Laravel 11"
                    class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('title') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                    value="{{old('title')}}"
                    >
                    @error('title')
                    <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="description" class="mb-2 block text-xl">Descripción: </label>
                    <textarea 
                    name="description" 
                    id="description"
                    rows="5"
                    placeholder="Aprendiendo Route Model Binding..."
                    class="border-2 border-solid border-blue-300 focus:outline-none focus:border-blue-500 @error('description') border-red-500 focus:border-red-500 @enderror rounded-lg block w-full p-4 text-xl placeholder:text-xl"
                    >{{old('description')}}</textarea>
                    
                    @error('description')
                    <p class="bg-red-500 p-2 text-center mt-2 rounded-lg text-white font-bold"> {{ $message }} </p>
                    @enderror
                </div>

                <input type="hidden" id="inputImage" name="image" value="{{old('image')}}">
                
                <input 
                type="submit"
                value="Compartir"
                class="text-blue-500 border border-solid w-full border-blue-500 p-3 text-xl rounded-lg font-semibold hover:bg-blue-900 hover:border-blue-500 hover:text-white transition duration-300 ease-in md:text-lg lg:text-xl md:p-2 lg:p-3 cursor-pointer"
                >
                
            </form>
        </div>
    </div>
</div>

@endsection