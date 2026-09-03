@extends('layouts.app')

@section('content')

    <main class="flex-1 mt-15 p-8">

        @if ($posts->count())
        
            <x-list-post :posts="$posts"/>

            <div class="mt-4">
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