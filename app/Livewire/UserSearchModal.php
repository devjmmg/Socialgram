<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserSearchModal extends Component
{
    public $search = '';

    #[On('reset-search')]
    public function resetSearch() {
        $this->reset('search');
    }

    public function render()
    {

        $users = collect();
        $hasMore = false;
        if ($this->search !== '' && strlen($this->search) >= 3) {
            $users = User::where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('username', 'LIKE', '%' . $this->search . '%')->orderBy('name', 'ASC')->orderBy('username', 'ASC')
                ->paginate(10);
            $hasMore = $users->total() > 10;
        }
        return view('livewire.user-search-modal', [
            'users' => $users,
            'hasMore' => $hasMore
        ]);
    }
}
