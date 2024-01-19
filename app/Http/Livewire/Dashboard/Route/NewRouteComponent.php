<?php

namespace App\Http\Livewire\Dashboard\Route;

use App\Models\Place;
use App\Models\Route;
use App\Models\Destiny;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NewRouteComponent extends Component
{
    public $places;
    public $place_id;
    public $destinies;
    public $destiny_id;
    public $price1;
    public $price2;
    public $price3;
    public $status;

    protected $listeners = [
        'routeStore',
    ];

    public function render()
    {
        return view('livewire.dashboard.route.new-route-component');
    }

    public function mount()
    {
        $this->destinies = Destiny::orderBy('name', 'asc')->get();
        $this->places = Place::where('active', 1)
            ->orderBy('name', 'asc')
            ->get();

        if(Auth::user()->utype == 'user'){
            $this->place_id = Session::get('place_id');
        }

    }

    public function storeRoute()
    {
        $this->dispatchBrowserEvent('alert', ['type' => 'info', 'title' => 'Aguarde...',  'message' => 'Salvando rota, aguarde ser redirecionado...']);

        $this->validate([
            'destiny_id' => 'required',
            'price1' => 'required',
            'price2' => 'required',
            'price3' => 'required',
            'status' => 'required',
        ],[
            'destiny_id.required' => 'O campo DESTINO é obrigatório',
            'price1.required' => 'O campo VALOR 1 é obrigatório',
            'price2.required' => 'O campo VALOR 2 é obrigatório',
            'price3.required' => 'O campo VALOR 3 é obrigatório',
            'status.required' => 'O campo STATUS é obrigatório',
        ]);

        try {
            $route = Route::where('place_id', $this->place_id)
                ->where('destiny_id', $this->destiny_id)
                ->first();

            if ($route) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'title' => 'Opss...',  'message' => 'Rota já cadastrada para está loja! Verifique os dados e tente novamente.']);
                return;
            }

            $route = new Route();
            $route->place_id = $this->place_id;
            $route->destiny_id = $this->destiny_id;
            $route->price1 = str_replace(',', '.', $this->price1);
            $route->price2 = str_replace(',', '.', $this->price2);
            $route->price3 = str_replace(',', '.', $this->price3);
            $route->status = $this->status;
            $route->save();

            $this->resetInput();

            $this->emit('routeStore');

        } catch(\Exception $e){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Erro ao cadastrar rota!']);
        }
    }

    private function resetInput()
    {
        $this->place_id = null;
        $this->destiny_id = null;
        $this->price1 = null;
        $this->price2 = null;
        $this->price3 = null;
        $this->status = null;
    }

    public function routeStore()
    {
        session()->flash('message', 'Rota criada com sucesso.');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Rota criada com sucesso.']);

        return redirect()->route('dashboard.routes');
    }
}
