<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class FeedPost extends Component
{
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
        $posts = Post::with('user')->whereIn('user_id', auth()->user()->following()->wherePivot('status', 'accepted')->select('users.id'))
                ->where('created_at', '>=', now()->subMonth())
                ->latest()
                ->paginate($this->perPage, ['*'], 'page', $this->page);

        $this->posts = collect($this->posts)->merge($posts->items());
        $this->hasMore = $posts->hasMorePages();
    }

    public function toogleLike(Post $post)
    {
        if ( $post->checkLike(auth()->user()) ) {
            $like = $post->likes()->where('user_id', auth()->user()->id)->first();
            $like?->delete();
        } else {
            $post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.posts.feed-post');
    }
}
