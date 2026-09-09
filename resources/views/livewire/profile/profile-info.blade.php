<div class="flex flex-col gap-1">
    <p class="text-lg text-gray-800 font-semibold">
        {{$followers}} 
        <span class="font-normal"> @choice('Seguidor|Seguidores', $followers) </span>
    </p>
    
    <p class="text-lg text-gray-800 font-semibold">
        {{$following}} <span class="font-normal">Siguiendo</span>
    </p>
    
    <p class="text-lg text-gray-800 font-semibold">
        {{$total}} <span class="font-normal">Post</span>
    </p>
</div>