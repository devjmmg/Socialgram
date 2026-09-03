<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class UserSearch extends Component
{
    #[Url(except: '')]
    public string $search = '';

    #[On('friend-request-updated')]
    public function refreshRequests() {}

    public int $perPage = 20;
    public bool $hasMore = false;

    public function loadMore()
    {
        $this->perPage += 20;
    }

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

        $users = collect();
        if ($this->search !== '' && strlen($this->search) >= 3) {
            $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('username', 'LIKE', '%' . $this->search . '%')
                ->orderBy('name', 'ASC')->orderBy('username', 'ASC')
                ->paginate($this->perPage);
            $this->hasMore = $users->hasMorePages();
        }

        return view('livewire.user-search', [
            'users' => $users,
        ]);
    }
}
