<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UpdateUser extends Component
{
    public ?User $user;
    public ?string $name;
    public ?string $email;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.user.update-user');
    }

    public function update()
    {
        $this->user->fill([
            'name' => $this->name,
            'email' => $this->email,
        ])->update();
        $this->dispatchBrowserEvent('updatedUser');
    }
}
