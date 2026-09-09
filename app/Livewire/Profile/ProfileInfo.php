<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ProfileInfo extends Component
{

    public User $user;

    #[On('friend-request-updated')]
    public function refreshRequests() {}

    public function render()
    {
        return view('livewire.profile.profile-info', [
            'total' => $this->user->posts()->count(),
            'followers' => $this->user->followers()->wherePivot('status', 'accepted')->count(),
            'following' => $this->user->following()->wherePivot('status', 'accepted')->count(),
        ]);
    }
}
