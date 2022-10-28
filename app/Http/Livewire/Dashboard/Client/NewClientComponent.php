<?php

namespace App\Http\Livewire\Dashboard\Client;

use App\Models\Client;
use Livewire\Component;

class NewClientComponent extends Component
{
    public $name;
    public $rg;
    public $cpfcnpj;
    public $email;
    public $phone;
    public $zip_code;
    public $address;
    public $number;
    public $complement;
    public $district;
    public $city;
    public $state;


    public function store()
    {
        $this->validate([
            'name' => 'required|min:3',
            'rg' => 'min:7',
            'cpfcnpj' => 'required|numeric|unique:clients,cpfcnpj',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|min:10',
            'zip_code' => 'required|min:8',
            'address' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'name.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'rg.min' => 'O campo RG deve ter no mínimo 7 caracteres',
            'cpfcnpj.required' => 'O campo CPF/CNPJ é obrigatório',
            'cpfcnpj.numeric' => 'O campo CPF/CNPJ deve conter apenas números',
            'cpfcnpj.unique' => 'O CPF/CNPJ informado já está cadastrado',
            'email.required' => 'O campo e-mail é obrigatório',
            'email.email' => 'O campo e-mail deve ser um e-mail válido',
            'email.unique' => 'O e-mail informado já está cadastrado',
            'phone.required' => 'O campo telefone é obrigatório',
            'phone.min' => 'O campo telefone deve ter no mínimo 10 caracteres',
            'zip_code.required' => 'O campo CEP é obrigatório',
            'zip_code.numeric' => 'O campo CEP deve conter apenas números',
            'zip_code.min' => 'O campo CEP deve ter no mínimo 8 caracteres',
            'address.required' => 'O campo endereço é obrigatório',
            'number.required' => 'O campo número é obrigatório',
            'district.required' => 'O campo bairro é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
        ]);

        try {
            $client = new Client();
            $client->name = $this->name;
            $client->rg = $this->rg;
            $client->cpfcnpj = $this->cpfcnpj;
            $client->email = $this->email;
            $client->phone = $this->phone;
            $client->zip_code = $this->zip_code;
            $client->address = $this->address;
            $client->number = $this->number;
            $client->complement = $this->complement;
            $client->district = $this->district;
            $client->city = $this->city;
            $client->state = $this->state;
            $client->save();

            if ($client) {
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Cliente cadastrado com sucesso!']);
                return redirect()->route('dashboard.clients');
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Erro ao cadastrar cliente! ' .$e->getMessage()]);
        }
    }

    public function viaCep()
    {
        $this->validate([
            'zip_code' => 'required|min:8|max:9',
        ],[
            'zip_code.required' => 'O campo CEP é obrigatório',
            'zip_code.min' => 'O campo CEP deve ter no mínimo 8 caracteres',
            'zip_code.max' => 'O campo CEP deve ter no máximo 9 caracteres',
        ]);

        $url = "https://viacep.com.br/ws/{$this->zip_code}/json/";

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

    public function render()
    {
        return view('livewire.dashboard.client.new-client-component');
    }
}
