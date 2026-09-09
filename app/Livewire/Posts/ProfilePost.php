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

    public int $page = 1;
    public int $perPage = 20;
    public bool $hasMore = false;

    public $posts = [];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadMore()
    {
        if (!$this->hasMore) {
            return;
        }
        $this->page++;
        $this->loadPosts();
    }

    private function loadPosts()
    {
        $posts = $this->user->posts()->latest()->paginate($this->perPage, ['*'], 'page', $this->page);
        $this->posts = collect($this->posts)->merge($posts->items());
        $this->hasMore = $posts->hasMorePages();
    }

    public function render()
    {
        return view('livewire.posts.profile-post');
    }
}