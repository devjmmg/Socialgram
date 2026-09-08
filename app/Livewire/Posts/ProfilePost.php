<?php

namespace App\Livewire\Posts;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfilePost extends Component
{

    #[On('friend-request-updated')]
    public function refreshRequests() {}

    public User $user;

    public int $perPage = 20;
    public bool $hasMore = false;

    public function loadMore()
    {
        $this->perPage += 20;
    }

    public function render()
    {
        $posts = $this->user->posts()->latest()->paginate($this->perPage);
        $this->hasMore = $posts->hasMorePages();
        return view('livewire.posts.profile-post', [
            'posts' => $posts
        ]);
    }
}
