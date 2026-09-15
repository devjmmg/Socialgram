<?php

namespace App\Livewire\Posts;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\PostCommented;
use Livewire\Attributes\On;
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

    public ?Comment $reply = null;

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
        $comments = $this->post->comments()->whereNull('parent_id')->with('user')
        ->with([
            'replies' => function ($query) {
                $query->with('user')->withCount('likes');
            }
        ])
        ->withCount('likes')->latest()->paginate($this->perPage, ['*'], 'page', $this->page);
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

        $parent_id = $this->reply?->id;

        $comment = $this->post->comments()->create([
            'comment' => $this->comment,
            'user_id' => auth()->id(),
            'parent_id' => $this->reply?->id
        ]);

        if ($comment->post->user_id !== auth()->id()) {
            $comment->post->user->notify( new PostCommented(auth()->user(), $comment) );
        }

        $this->reply = null;
        $this->reset('comment');

        if ($parent_id) {
            $this->dispatch('reply-created', parent_id: $parent_id);
            return;
        }

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

        while (!$this->commentExists($this->commentId) && $this->hasMore) {
            $this->page++;
            $this->loadComments();
        }

        if ($this->commentExists($this->commentId)) {
            $this->dispatch('comment-found', commentId: $this->commentId);
        }
    }

    private function commentExists(int $commentId)
    {
        foreach ($this->comments as $comment) {

            if ($comment->id === $commentId) {
                return true;
            }

            if ($comment->replies->contains('id', $commentId)) {
                return true;
            }
        }

        return false;
    }

    #[On('reply-to')]
    public function replyTo(Comment $comment)
    {
        $this->reply = $comment->load('user');
        $this->dispatch('focus-comment');
    }

    public function cancelReply()
    {
        $this->reply = null;
    }

    public function render()
    {
        return view('livewire.posts.comments');
    }
}