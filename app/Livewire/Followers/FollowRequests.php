<?php

namespace App\Livewire\Followers;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowRequests extends Component
{

    public int $page = 1;
    public int $perPage = 20;
    public bool $hasMore = false;

    public $pendingFollowers = [];

    #[On('follow-request-updated')]
    public function refreshRequests() {}

    public function mount()
    {
        $this->loadFollowers();
    }

    public function loadMore()
    {
        if (!$this->hasMore) {
            return;
        }
        $this->page++;
        $this->loadFollowers();
    }

    private function loadFollowers()
    {
        $pendingFollowers = auth()->user()->followers()->wherePivot('status', 'pending')->orderByPivot('created_at', 'ASC')->paginate($this->perPage, ['*'], 'page', $this->page);
        $this->pendingFollowers = collect($this->pendingFollowers)->merge($pendingFollowers->items());
        $this->hasMore = $pendingFollowers->hasMorePages();
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
        return view('livewire.followers.follow-requests');
    }
}
