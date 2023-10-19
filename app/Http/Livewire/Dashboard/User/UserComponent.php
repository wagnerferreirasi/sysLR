<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class UserComponent extends Component
{
    public function render()
    {
        $users = cache()->rememberForever('users', function () {
            return User::all();
        });

        //dd($users);

        return view('livewire.dashboard.user.user-component', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $this->dispatchBrowserEvent('showModal', ['user' => $user]);
    }
}
