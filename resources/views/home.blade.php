@extends('layouts.app')

@section('history')

{{-- <section class="mt-15">

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

</section> --}}

@endsection

@section('content')

    <main class="flex-1 mt-15">

        @if ($posts->count()) 

            <div class="flex flex-col items-center gap-4">
                <x-list-post :posts="$posts"/>
            </div>

            <div class="mt-4">
                {{-- {{$posts->links()}} --}}
                {{ $posts->links('pagination::tailwind') }}
            </div>

        @else

            <div class="py-12 text-center">
                <p class="text-sm font-medium text-gray-500">
                    Aún no hay publicaciones de tus amigos
                </p>
                <p class="mt-1 text-xs text-gray-400">
                    Cuando tus amigos publiquen algo, aparecerá aquí.
                </p>
            </div>

        @endif

    </main>

@endsection