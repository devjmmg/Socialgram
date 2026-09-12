<?php

namespace App\Livewire;

use App\Notifications\PostLiked;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount()
    {
        if ( auth()->check()) {
            $this->isLiked = $this->post->checkLike(auth()->user());
        } else {
            $this->isLiked = false;
        }
        $this->likes = $this->post->likes()->count();
    }

    public function like()
    {
        if ( $this->post->checkLike(auth()->user()) ) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
            if ($this->post->user_id !== auth()->id()) {
                $this->post->user->notify( new PostLiked(auth()->user(), $this->post) );
            }
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
