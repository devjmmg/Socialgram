<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8">
        @foreach($posts as $post)
        <a href="{{route('posts.show',['user' => $post->user, 'post' => $post])}}">
            <img loading="lazy" class="rounded-lg md:hover:scale-105 md:transition md:ease-in md:duration-300 cursor-pointer" src="{{asset('uploads/'.$post->image)}}" alt="Imagen Post">
        </a>
        @endforeach
    </div>
</div>