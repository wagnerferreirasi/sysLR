<?php

namespace App\Http\Livewire\Dashboard\Place;

use App\Models\Place;
use Livewire\Component;

class EditPlaceComponent extends Component
{
    public $place_id;
    public $name;
    public $phone;
    public $email;
    public $cnpj;
    public $zipcode;
    public $address;
    public $number;
    public $complement;
    public $district;
    public $city;
    public $state;

    public function mount($id)
    {
        $place = Place::find($id);
        $this->place_id = $place->id;
        $this->name = $place->name;
        $this->phone = $place->phone;
        $this->email = $place->email;
        $this->cnpj = $place->cnpj;
        $this->zipcode = $place->zipcode;
        $this->address = $place->address;
        $this->number = $place->number;
        $this->complement = $place->complement;
        $this->district = $place->district;
        $this->city = $place->city;
        $this->state = $place->state;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'email' => 'required|email',
            'cnpj' => 'required|numeric',
            'zipcode' => 'required|min:8',
            'address' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'phone.required' => 'O campo telefone é obrigatório',
            'phone.min' => 'O campo telefone deve ter no mínimo 10 caracteres',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'O campo e-mail deve ser um e-mail válido',
            'cnpj.required' => 'O campo CNPJ é obrigatório',
            'cnpj.numeric' => 'O campo CNPJ deve conter apenas números',
            'zipcode.required' => 'O campo CEP é obrigatório',
            'zipcode.min' => 'O campo CEP deve ter no mínimo 8 caracteres',
            'address.required' => 'O campo endereço é obrigatório',
            'number.required' => 'O campo número é obrigatório',
            'district.required' => 'O campo bairro é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
        ]);

        try {
            $place = Place::find($this->place_id);
            $place->name = $this->name;
            $place->phone = $this->phone;
            $place->email = $this->email;
            $place->cnpj = $this->cnpj;
            $place->zipcode = $this->zipcode;
            $place->address = $this->address;
            $place->number = $this->number;
            $place->complement = $this->complement;
            $place->district = $this->district;
            $place->city = $this->city;
            $place->state = $this->state;
            $place->save();

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Loja atualizado com sucesso!'
            ]);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Erro ao atualizar loja!'
            ]);
        }
    }
    public function render()
    {
        return view('livewire.dashboard.place.edit-place-component');
    }
}
