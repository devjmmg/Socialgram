<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public int $page = 1;
    public int $perPage = 5;
    public bool $hasMore = false;

    public Post $post;
    public string $comment = '';

    public $comments = [];

    public function mount()
    {
        $this->loadComments();
    }

    public function loadMore()
    {
        if (!$this->hasMore) {
            return;
        }

        $this->page++;
        $this->loadComments();
    }

    private function loadComments()
    {
        $comments = $this->post->comments()->with('user')->latest()->paginate($this->perPage, ['*'], 'page', $this->page);
        $this->comments = collect($this->comments)->merge($comments->items());
        $this->hasMore = $comments->hasMorePages();
    }

    private function reloadComments()
    {
        $current = $this->page;

        $this->page = 1;
        $this->comments = [];

        for ($page = 1; $page <= $current; $page++) {
            $this->page = $page;
            $this->loadComments();
        }
    }

    public function store()
    {
        if (trim($this->comment) === '') {
            return;
        }
        $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id()
        ]);
        $this->reset('comment');
        $this->reloadComments();
    }

    public function render()
    {
        return view('livewire.posts.comments');
    }
}