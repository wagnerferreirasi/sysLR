<?php

namespace App\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;
use Illuminate\Validation\Rule;

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
            'city' => 'required',
            'state' => ['required','max:2', Rule::in("AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO")],
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'phone.required' => 'O campo telefone é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
            'state.max' => 'O campo estado deve ter no máximo 2 caracteres',
            'state.rules' => 'O campo estado deve ser AC, AL, AP, AM, BA, CE, DF, ES, GO, MA, MT, MS, MG, PA, PB, PR, PE, PI, RJ, RN, RS, RO, RR, SC, SP, SE, TO',
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
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Destino cadastrado com sucesso!']);
        } catch (\Exception $e) {
            $this->dispatch('alert', ['type' => 'error',  'message' => 'Erro ao cadastrar destino!' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.destiny.new-destiny-component');
    }
}
