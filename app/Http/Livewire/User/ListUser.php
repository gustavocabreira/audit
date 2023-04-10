<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class ListUser extends Component
{
    public $users;

    protected $listeners = ['userCreated' => 'refreshUsers'];

    public function mount()
    {
        $this->users = User::query()->latest()->get();
    }

    public function render()
    {
        return view('livewire.user.list-user');
    }

    public function refreshUsers()
    {
        $this->users = User::query()->latest()->get();
    }
}
