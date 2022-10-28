<?php

namespace App\Http\Livewire\Dashboard\Route;

use App\Models\Route;
use App\Models\Destiny;
use Livewire\Component;

class EditRouteComponent extends Component
{
    public $route_id;
    public $place_id;
    public $destinies;
    public $destiny_id;
    public $price1;
    public $price2;
    public $price3;
    public $status;

    public function render()
    {
        return view('livewire.dashboard.route.edit-route-component');
    }

    public function mount($id)
    {
        $route = Route::find($id);
        $this->route_id = $route->id;
        $this->place_id = $route->place_id;
        $this->destiny_id = $route->destiny_id;
        $this->price1 = str_replace('.', ',', $route->price1);
        $this->price2 = str_replace('.', ',', $route->price2);
        $this->price3 = str_replace('.', ',', $route->price3);
        $this->destinies = Destiny::all();
    }

    public function update()
    {
        $this->dispatchBrowserEvent('alert', ['type' => 'info',  'message' => 'Atualizando rota, aguarde ser redirecionado...']);

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
            $route = Route::find($this->route_id);
            $route->destiny_id = $this->destiny_id;
            $route->price1 = str_replace(',', '.', $this->price1);
            $route->price2 = str_replace(',', '.', $this->price2);
            $route->price3 = str_replace(',', '.', $this->price3);
            $route->status = $this->status;
            $route->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Rota atualizada com sucesso!']);
            return redirect()->route('dashboard.routes');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Erro ao atualizar rota!' . $e->getMessage()]);
        }
    }
}
