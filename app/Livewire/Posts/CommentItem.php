<?php

namespace App\Livewire\Posts;

use App\Models\Comment;
use App\Notifications\LikeComment;
use Livewire\Attributes\On;
use Livewire\Component;

class CommentItem extends Component
{

    public Comment $comment;

    public function toggleLike(Comment $comment)
    {
        $like = $comment->likes()->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create([
                'user_id' => auth()->id()
            ]);
            if ($comment->user_id !== auth()->id()) {
                $comment->user->notify( new LikeComment(auth()->user(), $comment) );
            }
        }
        $this->comment->load([
            'replies' => function ($query) {
                $query->with('user')->withCount('likes');
            }
        ]);
        $this->comment->loadCount('likes');
    }

    #[On('reply-created')]
    public function freshReplies(int $parent_id)
    {
        // if ($this->comment->id !== $parent_id) {
        //     return;
        // }

        $this->comment->load([
            'replies' => function($query) {
                $query->with('user')->withCount('likes');
            }
        ]);
        $this->comment->loadCount('likes');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        $this->comment->loadCount('likes');
        $this->comment->load([
            'replies' => function ($query) {
                $query->with('user')->withCount('likes');
            }
        ]);
    }

    public function render()
    {
        return view('livewire.posts.comment-item');
    }
}
