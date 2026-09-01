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

    public int $perPage = 20;
    public bool $hasMore = false;

    public function loadMore()
    {
        $this->perPage += 20;
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
