<?php

namespace App\Livewire\Followers;

use App\Models\User;
use App\Notifications\AcceptedFollower;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowRequestsProfile extends Component
{
    #[On('follow-request-updated')]
    public function refreshRequests() {}

    public User $user;
    public $hasPendingRequest = false;

    public function accept(User $user)
    {
        $follow = auth()->user()->followers()->where('follower_id', $user->id)->wherePivot('status', 'pending')->first();
        if (!$follow) {
            return;
        }
        $follow->pivot->update([
            'status' => 'accepted'
        ]);
        if ($user->id !== auth()->id()) {
            $user->notify( new AcceptedFollower(auth()->user()) );
        }
        $this->dispatch('follow-request-updated');
        $this->dispatch('friend-request-updated');
    }

    public function reject(User $user)
    {
        $follow = auth()->user()->followers()->where('follower_id', $user->id)->wherePivot('status', 'pending')->first();
        if (!$follow) {
            return;
        }
        $follow->pivot->delete();
        $this->dispatch('follow-request-updated');
        $this->dispatch('friend-request-updated');
    }
    
    public function render()
    {
        $this->hasPendingRequest = auth()->check() ? auth()->user()->followers()->wherePivot('user_id', auth()->id())->wherePivot('follower_id', $this->user->id)->wherePivot('status', 'pending')->exists() : false;
        return view('livewire.followers.follow-requests-profile');
    }
}
