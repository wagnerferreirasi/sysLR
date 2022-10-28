<?php

namespace App\Http\Livewire\Dashboard\Route;

use App\Models\Route;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RouteComponent extends Component
{

    public function mount()
    {
        if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'master'){
            $this->routes = Route::all();
        }else{
            $this->routes = Route::where('place_id', session()->get('place_id'))->get();
        }
    }

    public function render()
    {
        return view('livewire.dashboard.route.route-component');
    }

    public function delete($id)
    {
        $route = Route::find($id);

        $package = Package::where('destiny_id', $route->destiny_id)
                    ->where('place_id', $route->place_id)
                    ->first();

        if($package){
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Esta rota está sendo usada em um pacote, não é possível excluí-la!']);
        }else{
            $route->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Rota excluída com sucesso!']);
            return redirect()->route('dashboard.routes');
        }
    }
}
