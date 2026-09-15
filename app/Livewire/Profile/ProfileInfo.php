<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileInfo extends Component
{

    public User $user;
    public ?string $showUsers = null;

    #[On('friend-request-updated')]
    public function refreshRequests() {}

    public function showFollowers()
    {
        $this->showUsers = 'followers';
    }

    public function showFollowing()
    {
        $this->showUsers = 'following';
    }

    public function closeUsers()
    {
        $this->showUsers = null;
    }

    public function render()
    {
        $users = collect();

        if ($this->showUsers === 'followers') {
            $users = $this->user->followers()->wherePivot('status', 'accepted')->get();
        }

        if ($this->showUsers === 'following') {
            $users = $this->user->following()->wherePivot('status', 'accepted')->get();
        }

        return view('livewire.profile.profile-info', [
            'total' => $this->user->posts()->count(),
            'followers' => $this->user->followers()->wherePivot('status', 'accepted')->count(),
            'following' => $this->user->following()->wherePivot('status', 'accepted')->count(),
            'users' => $users,
        ]);
    }
}
