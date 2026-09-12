<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Notifications extends Component
{

    public $notifications;
    public $users;
    public $posts;
    public $comments;
    public $unreadCount;
    public $hasMoreNotifications = false;

    public function mount()
    {
        $notifications = auth()->user()->notifications()->where('created_at', '>=', now()->subMonth());

        $this->notifications = $notifications->latest()->take(10)->get();
        $this->hasMoreNotifications = $notifications->count() > 10;

        $userIds = $this->notifications->map(fn ($n) => $n->data['user_id'])->unique();
        $this->users = User::whereIn('id', $userIds)->get()->keyBy('id');

        //Like Notification
        $likeNotification = $this->notifications->where('data.type', 'like');
        $postIds = $likeNotification->map(fn ($n) => $n->data['post_id'])->unique();
        $this->posts = Post::whereIn('id', $postIds)->get()->keyBy('id');

        $likeCommentNotification = $this->notifications->where('data.type', 'like_comment');
        $commentIds = $likeCommentNotification->map(fn ($n) => $n->data['comment_id'])->unique();
        $this->comments = Comment::whereIn('id', $commentIds)->with('post')->get()->keyBy('id');

        $this->unreadCount = auth()->user()->unreadNotifications()->count();
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications()->update([
            'read_at' => now(),
        ]);
        $this->unreadCount = 0;
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
