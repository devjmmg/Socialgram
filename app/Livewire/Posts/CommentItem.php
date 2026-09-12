<?php

namespace App\Livewire\Posts;

use App\Models\Comment;
use App\Notifications\LikeComment;
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
            if ($this->comment->user_id !== auth()->id()) {
                $this->comment->user->notify( new LikeComment(auth()->user(), $this->comment) );
            }
        }
        $this->comment->loadCount('likes');
    }

    public function render()
    {
        return view('livewire.posts.comment-item');
    }
}
