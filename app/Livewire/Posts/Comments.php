<?php

namespace App\Livewire\Posts;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public int $page = 1;
    public int $perPage = 10;
    public bool $hasMore = false;

    public Post $post;
    public string $comment = ''; // wire.model="comment" -> comments.blade.php

    public $comments = [];
    public ?int $commentId = null; // Localizar el comentario a resaltar

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
        $comments = $this->post->comments()->with('user')->withCount('likes')->latest()->paginate($this->perPage, ['*'], 'page', $this->page);
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

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        $this->reloadComments();
    }

    public function updatedCommentId()
    {
        $this->findComment();
    }

    public function findComment()
    {
        if (!$this->commentId) {
            return;
        }

        while (!$this->comments->contains('id', $this->commentId) && $this->hasMore) {
            $this->page++;
            $this->loadComments();
        }

        if ($this->comments->contains('id', $this->commentId)) {
            $this->dispatch('comment-found', commentId: $this->commentId);
        }
    }

    public function render()
    {
        return view('livewire.posts.comments');
    }
}