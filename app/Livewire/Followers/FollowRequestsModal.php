<?php

namespace App\Livewire\Followers;

use App\Models\User;
use App\Notifications\AcceptedFollower;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowRequestsModal extends Component
{

    #[On('follow-request-updated')]
    public function refreshRequests() {}

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
        $pendingFollowers = auth()->check() ? auth()->user()->followers()->wherePivot('status', 'pending')->orderByPivot('created_at', 'DESC')->paginate(5) : collect();
        $pendingFollowersTotal = auth()->check() ? $pendingFollowers->total() : 0;
        return view('livewire.followers.follow-requests-modal', [
            'pendingFollowers' => $pendingFollowers,
            'pendingFollowersTotal' => $pendingFollowersTotal
        ]);
    }
}
