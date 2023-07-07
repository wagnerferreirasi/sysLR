<?php

namespace App\Http\Livewire\Dashboard\Password;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use App\Models\Password;

class PasswordComponent extends Component
{
    public string $password;

    protected $listeners = [
        'setPassword' => 'setPassword',
        'passwordGenerated' => 'savePassword',
        'passwordSaved' => '$refresh'
    ];

    public function render(): View
    {
        if (auth()->user()->hasRole('admin')) {
            $pwd = json_decode($this->password);
            return view('livewire.dashboard.password.password-component', compact('pwd'));
        }

        return view('livewire.dashboard.password.password-component');
    }

    public function mount(): void
    {
        $this->setPassword();
    }

    private function generatePassword(): string
    {
        return Str::random(6);
    }

    public function setPassword(): void
    {
        $password = Password::available()->first();

        if ($password && $password->expiration_date->isPast()) {
            $password->update(['status' => 'expired']);
            $password = null;
        }

        if ($password) {
            $this->password = $password;
            return;
        }

        $this->password = $this->generatePassword();
        $this->savePassword();

    }

    public function savePassword(): void
    {
        Password::create([
            'password' => $this->password,
            'expiration_date' => now()->addMinute(3),
            'status' => 'available'
        ]);

        $this->emit('passwordSaved');
    }

    public function forcePassword(): void
    {
        $password = Password::available()->first();
        $password->update(['status' => 'expired']);

        $this->password = $this->generatePassword();
        $this->savePassword();
    }

    public function passwordCheck($password): bool
    {
        if ($password === $this->password) {
            return true;
        }

        return false;
    }
}
