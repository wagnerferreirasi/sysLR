<?php

namespace App\Http\Livewire\Dashboard\Place;

use App\Models\Place;
use Livewire\Component;

class NewPlaceComponent extends Component
{
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

    public function render()
    {
        return view('livewire.dashboard.place.new-place-component');
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:10',
            'email' => 'required|email|unique:places,email',
            'cnpj' => 'required|numeric|unique:places,cnpj',
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
            'email.unique' => 'O e-mail informado já está cadastrado',
            'cnpj.required' => 'O campo CNPJ é obrigatório',
            'cnpj.numeric' => 'O campo CNPJ deve conter apenas números',
            'cnpj.unique' => 'O CNPJ informado já está cadastrado',
            'zipcode.required' => 'O campo CEP é obrigatório',
            'zipcode.min' => 'O campo CEP deve ter no mínimo 8 caracteres',
            'address.required' => 'O campo endereço é obrigatório',
            'number.required' => 'O campo número é obrigatório',
            'district.required' => 'O campo bairro é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
        ]);

        try {
            Place::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'cnpj' => $this->cnpj,
                'zipcode' => $this->zipcode,
                'address' => $this->address,
                'number' => $this->number,
                'complement' => $this->complement,
                'district' => $this->district,
                'city' => $this->city,
                'state' => $this->state,
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Local cadastrado com sucesso!']);
            return redirect()->route('dashboard.places');

        }
        catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Erro ao cadastrar a Loja: ' . $e->getMessage()
            ]);
            return redirect()->route('dashboard.places');
        }
    }

    public function viaCep()
    {
        $this->validate([
            'zipcode' => 'required|min:8|max:9',
        ],[
            'zipcode.required' => 'O campo CEP é obrigatório',
            'zipcode.min' => 'O campo CEP deve ter no mínimo 8 caracteres',
            'zipcode.max' => 'O campo CEP deve ter no máximo 9 caracteres',
        ]);

        $url = "https://viacep.com.br/ws/{$this->zipcode}/json/";

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);
        $data = json_decode($response->getBody());

        if (isset($data->erro)) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Cep não encontrado! Tente novamente.',
                'title' => 'Ops... Algo deu errado!'
            ]);
            return;
        }

        $this->address = $data->logradouro;
        $this->district = $data->bairro;
        $this->city = $data->localidade;
        $this->state = $data->uf;
    }
}
