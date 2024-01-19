<?php

namespace App\Livewire\Dashboard\Route;

use PDF;
use App\Libs\ExceptionsLib;
use App\Models\Route;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RouteComponent extends Component
{
    public $routes;

    public function mount()
    {
        $this->routes = cache()->rememberForever('routes', function () {
            return Route::with('place', 'destiny')->get();
        });
    }

    public function exportData()
    {
        $routes = Route::select('routes.*', 'places.name as place_name', 'destinies.name as destiny_name')
                        ->orderBy('routes.id', 'DESC')
                        ->join('places', 'places.id', '=', 'routes.place_id')
                        ->join('destinies', 'destinies.id', '=', 'routes.destiny_id')
                        ->get();

        $pdfContent = PDF::loadView('export.exportRoutes', ['routes' => $routes])->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "routes.pdf"
        );

        $this->dispatch('alert', ['type' => 'success', 'message' => 'Dados exportados com sucesso!']);
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
            $this->dispatch('alert', ['type' => 'success',  'message' => ExceptionsLib::routeExcluded()->getMessage()]);
            return redirect()->route('dashboard.routes');
        }

        $this->dispatch('alert', ['type' => 'error',  'message' => ExceptionsLib::routeInUse()->getMessage()]);
    }
}
