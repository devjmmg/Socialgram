<?php

namespace App\Livewire\Followers;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowButton extends Component
{

    public User $user;

    #[On('friend-request-updated')]
    public function refreshRequests() {}

    public function follow(User $user)
    {
        $user->followers()->attach( auth()->user()->id );
        $this->dispatch('friend-request-updated');
    }

    public function unfollow(User $user)
    {
        $user->followers()->detach( auth()->user()->id );
        $this->dispatch('friend-request-updated');
    }

    public function render()
    {
        return view('livewire.followers.follow-button');
    }
}
