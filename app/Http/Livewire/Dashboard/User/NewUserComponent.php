<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\User;
use Livewire\Component;

class NewUserComponent extends Component
{
    public $name;
    public $login;
    public $email;
    public $utype;
    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.dashboard.user.new-user-component');
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name'                  => 'required',
            'login'                 => 'required|unique:users,login',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'name'      => $validatedData['name'],
            'login'     => $validatedData['login'],
            'email'     => $validatedData['email'],
            'password'  => bcrypt($validatedData['password']),
        ]);

        $user->assignRole($this->utype);

        return redirect()->route('dashboard.users');
    }
}
