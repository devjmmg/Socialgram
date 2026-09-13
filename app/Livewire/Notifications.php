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
        $notifications = auth()->user()->notifications()->where('created_at', '>=', now()->subMonth())->latest()->get();

        // Users
        $userIds = $notifications->map(fn ($n) => $n->data['user_id'])->unique();
        $this->users = User::whereIn('id', $userIds)->get()->keyBy('id');

        $validNotifications = $notifications->filter(fn ($n) => isset($this->users[$n->data['user_id']]));
        $this->hasMoreNotifications = $validNotifications->count() > 5;
        $this->notifications = $validNotifications->take(5)->values(); // values -> reindexa los valores 0, 1, 2 ,3 ,4 ...

        // Like Notification
        $likeNotification = $this->notifications->where('data.type', 'like');
        $postIds = $likeNotification->map(fn ($n) => $n->data['post_id'])->unique();
        $this->posts = Post::whereIn('id', $postIds)->get()->keyBy('id');

        // Comment / LikeComment Notification
        $commentNotification = $this->notifications->whereIn('data.type', ['like_comment', 'comment']);
        $commentIds = $commentNotification->map(fn ($n) => $n->data['comment_id'])->unique();
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
