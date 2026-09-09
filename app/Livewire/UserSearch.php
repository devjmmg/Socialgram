<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserSearch extends Component
{

    public string $search = '';

    #[On('friend-request-updated')]
    public function refreshRequests() {}

    public int $page = 1;
    public int $perPage = 20;
    public bool $hasMore = false;

    public $users = [];

    public function updatedSearch()
    {
        $this->page = 1;
        $this->users = [];
        $this->hasMore = false;

        $this->loadUsers();
    }

    public function mount()
    {
        $this->search = request('search', '');
        $this->loadUsers();
    }

    public function loadMore()
    {
        if (!$this->hasMore) {
            return;
        }
        $this->page++;
        $this->loadUsers();
    }

    private function loadUsers()
    {
        if ($this->search !== '' && strlen($this->search) >= 3) {
            $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('username', 'LIKE', '%' . $this->search . '%')
                    ->orderBy('name', 'ASC')->orderBy('username', 'ASC')
                    ->paginate($this->perPage, ['*'], 'page', $this->page);
            $this->users = collect($this->users)->merge($users->items());
            $this->hasMore = $users->hasMorePages();
        }
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
        return view('livewire.user-search');
    }
}
