<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return response()->json([
            'success' => true,
            'data' => $clients
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validade = $request->validate([
            'type' => [
                'required',
                Rule::in(['client', 'company']),
            ],
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'phone' => 'required',
            'cpfcnpj' => 'required|unique:clients|numeric',
            'rg' => 'required|numeric',
            'address' => 'required',
            'number' => 'required',
            'district' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|numeric',
        ],[
            'type.required' => 'O campo tipo do cliente é obrigatório',
            'type.in' => 'O campo tipo do cliente deve ser client ou company',
        ]);

        $client = Client::create($request->all());

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso!',
            'success' => true,
            'data' => $client
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);

        if($client){
            return response()->json([
                'success' => true,
                'data' => $client
            ], 201);
        }

        return response()->json([
            'success' => false,
            'data' => [
                'message' => 'Cliente não encontrado, verifique o Id digitado!'
            ]
        ], 404);
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
