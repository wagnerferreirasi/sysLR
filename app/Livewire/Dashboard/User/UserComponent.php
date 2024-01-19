<?php

namespace App\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class UserComponent extends Component
{
    public $users;
    public $user;

    public function render()
    {
        $this->users = cache()->rememberForever('users', function () {
            return User::all();
        });

        return view('livewire.dashboard.user.user-component');
    }

    public function show($id)
    {
        $this->user = User::findOrFail($id);

        $this->dispatch('showModal', ['user' => $this->user]);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->dispatch('alert', ['type' => 'warning',  'message' => ('Usuario excluído com sucesso! Esta operação não pode ser desfeita!')]);
        sleep(3);

        return redirect()->route('dashboard.users');
    }
}
