<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public ?string $name;
    public ?string $email;
    public ?string $password;

    public function create()
    {
        $payload = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
        User::query()->create($payload);
        $this->emit('userCreated');
        $this->name = null;
        $this->email = null;
        $this->password = null;
    }

    public function render()
    {
        return view('livewire.user.create-user');
    }
}
