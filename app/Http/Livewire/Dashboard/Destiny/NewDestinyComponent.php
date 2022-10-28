<?php

namespace App\Http\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;

class NewDestinyComponent extends Component
{
    public $name;
    public $phone;
    public $address;
    public $city;
    public $state;

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'phone.required' => 'O campo telefone é obrigatório',
            'address.required' => 'O campo endereço é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
        ]);

        try {
            Destiny::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Destino cadastrado com sucesso!']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Erro ao cadastrar destino!']);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.destiny.new-destiny-component');
    }
}
