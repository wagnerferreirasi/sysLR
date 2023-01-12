<?php

namespace App\Http\Livewire\Dashboard\Route;

use App\Libs\ExceptionsLib;
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

        if(!$package){
            $route->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => ExceptionsLib::routeExcluded()->getMessage()]);
            return redirect()->route('dashboard.routes');
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => ExceptionsLib::routeInUse()->getMessage()]);
    }
}
