<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required',
            'cpfcnpj' => 'required|unique:clients|numeric',
            'rg' => 'required|numeric',
            'address' => 'required',
            'number' => 'required',
            'complement' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|numeric',
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está cadastrado',
            'phone.required' => 'O campo telefone é obrigatório',
            'cpfcnpj.required' => 'O campo cpf/cnpj é obrigatório',
            'cpfcnpj.unique' => 'O cpf/cnpj informado já está cadastrado',
            'cpfcnpj.numeric' => 'O campo cpf/cnpj deve ser um número',
            'rg.required' => 'O campo rg é obrigatório',
            'rg.numeric' => 'O campo rg deve ser um número',
            'address.required' => 'O campo endereço é obrigatório',
            'number.required' => 'O campo número é obrigatório',
            'complement.required' => 'O campo complemento é obrigatório',
            'district.required' => 'O campo bairro é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
            'zip_code.required' => 'O campo cep é obrigatório',
            'zip_code.numeric' => 'O campo cep deve ser um número',
        ]);

        return  Client::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Client::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
