<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class EditUserComponent extends Component
{
    public $user_id;
    public $user;

    public $name;
    public $login;
    public $email;
    public $password;


    public function mount($id)
    {
        $this->user_id = $id;
        $this->user = User::find($this->user_id);

        $this->name = $this->user->name;
        $this->login = $this->user->login;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.dashboard.user.edit-user-component');
    }

}
