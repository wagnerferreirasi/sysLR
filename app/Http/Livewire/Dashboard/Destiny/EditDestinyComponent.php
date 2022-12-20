<?php

namespace App\Http\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;

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
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'phone.required' => 'O campo telefone é obrigatório',
            'phone.min' => 'O campo telefone deve ter no mínimo 10 caracteres',
            'address.required' => 'O campo endereço é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
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
