<?php

namespace App\Http\Livewire\Auth;

use App\Models\Place;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $places;
    public $place;
    public $login;
    public $password;
    public $remember = false;

    protected $rules = [
        'login' => 'required',
        'password' => 'required|min:8',
        'place' => 'required',
    ], $messages = [
        'login.required' => 'O campo login é obrigatório',
        'password.required' => 'O campo senha é obrigatório',
        'password.min' => 'A senha deve ter no mínimo 8 caracteres',
        'place.required' => 'Selecione uma loja',
    ];


    public function validateLogin()
    {
        $this->validate($this->rules, $this->messages);

        $credentials = [
            'login' => $this->login,
            'password' => $this->password,
        ];

        if(Auth::attempt($credentials, $this->remember)) {
            $place = Place::find($this->place);
            session([
                'place_id' => $place->id,
                'place_name' => $place->name,
            ]);

            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Login realizado com sucesso! Redirecionando...']);

            return $this->redirect(route('dashboard'));

        } else {
            session()->flash('error', 'Login ou senha inválidos');
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Erro ao realizar login! Verifique os dados informados e tente novamente.']);

            return $this->render();
        }
    }

    public function render()
    {
        $this->places = cache()->rememberForever('places', function () {
            return Place::all();
        });

        return view('livewire.auth.login-component')->layout('layouts.guest');
    }
}
