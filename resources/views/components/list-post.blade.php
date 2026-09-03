 <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8">
    @foreach($posts as $post)
        <a href="{{ route('posts.show', ['user' => $post->user, 'post' => $post]) }}">
            <img loading="lazy" class="rounded-md md:hover:scale-105 md:transition md:ease-linear md:duration-300 cursor-pointer w-full max-w-96 max-h-96 mx-auto" src="{{ asset('storage/uploads/' . $post->image) }}" alt="Imagen Post">
        </a>
    @endforeach
</div>