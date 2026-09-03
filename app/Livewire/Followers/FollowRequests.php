<?php

namespace App\Livewire\Followers;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowRequests extends Component
{

    public int $perPage = 20;
    public bool $hasMore = false;

    #[On('follow-request-updated')]
    public function refreshRequests() {}

    public function loadMore()
    {
        $this->perPage += 20;
    }

    public function accept(User $user)
    {
        $follow = auth()->user()->followers()->where('follower_id', $user->id)->wherePivot('status', 'pending')->first();
        if (!$follow) {
            return;
        }
        $follow->pivot->update([
            'status' => 'accepted'
        ]);
        $this->dispatch('follow-request-updated');
    }

    public function reject(User $user)
    {
        $follow = auth()->user()->followers()->where('follower_id', $user->id)->wherePivot('status', 'pending')->first();
        if (!$follow) {
            return;
        }
        $follow->pivot->delete();
        $this->dispatch('follow-request-updated');
    }

    public function render()
    {
        $pendingFollowers = auth()->user()->followers()->wherePivot('status', 'pending')->orderByPivot('created_at', 'ASC')->paginate($this->perPage);
        $this->hasMore = $pendingFollowers->hasMorePages();
        return view('livewire.followers.follow-requests', [
            'pendingFollowers' => $pendingFollowers
        ]);
    }
}
