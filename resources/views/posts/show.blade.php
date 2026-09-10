@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')

    <main class="flex-1 mt-15 p-4">

        <div class="max-w-2xl mx-auto">

            <div class="bg-white rounded-md border border-gray-200 overflow-hidden">

                <div class="flex items-center justify-between p-4">

                    <div class="flex items-center gap-3">

                        <a href="{{ route('posts.index', $post->user->username) }}">

                            <img
                                class="w-10 h-10 rounded-full object-cover"
                                src="{{ empty($post->user->image) ? asset('storage/defaults/user.svg') : asset('storage/profile/' . $post->user->image) }}"
                                alt="Imagen de {{ $post->user->username }}"
                            >

                        </a>

                        <div class="flex flex-col">

                            <a
                                href="{{ route('posts.index', $post->user->username) }}"
                                class="font-semibold text-gray-800 hover:text-gray-600 transition-colors duration-200"
                            >
                                {{ $post->user->username }}
                            </a>

                            <span class="text-xs text-gray-500">
                                {{ str_replace('hace ', '', $post->created_at->diffForHumans()) }}
                            </span>

                        </div>

                    </div>

                    @auth

                        @if ($post->user_id === auth()->id())

                            <div
                                x-data="{ open: false }"
                                class="relative"
                            >

                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="p-2 rounded-full hover:bg-gray-200 transition-colors duration-300 ease-linear"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                    </svg>
                                </button>

                                <div
                                    x-show="open"
                                    x-cloak
                                    @click.outside="open = false"
                                    @keydown.escape.window="open = false"
                                    x-transition
                                    class="absolute right-0 top-full mt-2 w-48 bg-white border border-gray-200 rounded shadow z-10"
                                >

                                    <form
                                        action="{{ route('posts.destroy', $post) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="w-full text-left px-3 py-2 text-red-500"
                                        >
                                            Eliminar publicación
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endif

                    @endauth

                </div>

                <div>

                    <img
                        class="w-full aspect-square object-cover"
                        src="{{ asset('storage/uploads/' . $post->image) }}"
                        alt="Imagen Post"
                    >

                </div>

                <div class="flex items-center justify-evenly gap-6 p-4">

                    <livewire:like-post :post="$post" />

                    <a
                        href="#comment"
                        class="text-gray-700 hover:text-gray-500 transition-colors duration-200"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"
                            />
                        </svg>

                    </a>

                </div>

                <div class="p-4">

                    <p class="text-sm text-gray-800 leading-relaxed text-justify">

                        {{ $post->description }}

                    </p>

                </div>

                <div
                    id="comments"
                    class="border-t border-gray-200"
                >
                    <div class="p-4">

                        <h3 class="font-semibold text-gray-800">
                            Comentarios
                        </h3>

                    </div>

                    <livewire:posts.comments :post="$post" />

                </div>

            </div>

        </div>

    </main>

@endsection