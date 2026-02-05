@extends('layouts.app')

@section('title')
@endsection

@section('history')

<div class="my-4 mx-2 border-b border-gray-300">
    <div class="container mx-auto swiper w-full">
        <div class="mb-4 swiper-wrapper">

            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="{{ empty(auth()->user()->image) ? asset('img/usuario.svg') : asset('profiles/'.auth()->user()->image) }}"  alt="Imagen usuario">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            <img class="swiper-slide object-cover cursor-pointer rounded-2xl border-4 border-blue-500" src="https://bcw-media.s3.ap-northeast-1.amazonaws.com/text_to_image_v6_poster_01_f038887d26.jpg" alt="Image">
            
        </div>
    </div>
</div>

@endsection

@section('content')

{{-- Falta validar que el usuario que vamos a seguir ya anos haya aceptado para que mostremos nuestras publicaciones --}}

@if ($posts->count()) 

<div class="flex flex-col items-center gap-4">
    <x-list-post :posts="$posts"/>
</div>

<div class="mt-4">
    {{-- {{$posts->links()}} --}}
    {{ $posts->links('pagination::tailwind') }}
</div>

@else

<p class="text-center text-xl"> Aún no hay publicaciones de tus amigos...</p>

@endif

@endsection