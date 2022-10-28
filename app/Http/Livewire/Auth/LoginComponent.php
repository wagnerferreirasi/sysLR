<?php

namespace App\Http\Livewire\Auth;

use App\Models\Place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class LoginComponent extends Component
{
    public $places;
    public $place;
    public $login;
    public $password;

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

    protected $listeners = [
        'loginSuccess',
        'loginError'
    ];

    public function loginSuccess(): void
    {
        $this->redirect(route('dashboard'));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Login realizado com sucesso! Redirecionando...']);
    }

    public function loginError(): void
    {
        session()->flash('error', 'Login ou senha inválidos');
        $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Erro ao realizar login! Verifique os dados informados e tente novamente.']);
    }

    public function mount()
    {
        $this->places = Place::all();
    }

    public function validateLogin()
    {
        $this->dispatchBrowserEvent('loading_login');

        $this->validate($this->rules, $this->messages);

        $user = User::where('login', $this->login)
            ->where('active', 1)
            ->first();

        if ($user) {
            if(Auth::attempt(['login' => $this->login, 'password' => $this->password])) {
                $place = Place::find($this->place);
                session([
                    'place_id' => $place->id,
                    'place_name' => $place->name,
                ]);
                $this->emit('loginSuccess');
                Log::info('Login realizado com sucesso: ' . $this->login . ' - placeId: ' . $this->place);
            } else {
                $this->emit('loginError');
                Log::error('Login inválido: ' . $this->login . ' - placeId: ' . $this->place);
            }
        } else {
            $this->emit('loginError');
            Log::error('Login inválido: ' . $this->login . ' - placeId: ' . $this->place);
        }
    }

    public function render()
    {
        return view('livewire.auth.login-component')->layout('layouts.guest');
    }
}
