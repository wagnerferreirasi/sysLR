<?php

namespace App\Http\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EditDestinyComponent extends Component
{
    public $destiny_id;
    public $name;
    public $phone;
    public $address;
    public $city;
    public $state;

    public function mount($id)
    {
        $destiny = Destiny::find($id);
        $this->destiny_id = $destiny->id;
        $this->name = $destiny->name;
        $this->phone = $destiny->phone;
        $this->address = $destiny->address;
        $this->city = $destiny->city;
        $this->state = $destiny->state;
    }

    public function update(){
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
            $destiny = Destiny::find($this->destiny_id);
            $destiny->name = $this->name;
            $destiny->phone = $this->phone;
            $destiny->address = $this->address;
            $destiny->city = $this->city;
            $destiny->state = $this->state;
            $destiny->save();

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Deetino atualizado com sucesso!'
            ]);
            return redirect()->route('dashboard.destinies');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Erro ao atualizar Destino!'
            ]);
            return redirect()->route('dashboard.destinies');
        }
    }

    public function render()
    {
        return view('livewire.dashboard.destiny.edit-destiny-component');
    }


}
