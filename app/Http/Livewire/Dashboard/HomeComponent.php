<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Route;
use App\Models\Client;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class HomeComponent extends Component
{

    public function render()
    {
        $dataClient = ['chartClients' => $this->dataClientChart()];
        $dataRoute = ['chartRoutes' => $this->dataRouteChart()];
        $dataPackage = ['chartPackages' => $this->dataPackageChart()];

        $chartClients = $this->setChart($dataClient['chartClients'], 'clientsRegistered', 'Clientes cadastrados', 'line');
        $chartRoutes = $this->setChart($dataRoute['chartRoutes'], 'routesRegistered', 'Rotas cadastradas', 'bar');
        $chartPackages = $this->setChart($dataPackage['chartPackages'], 'packagesRegistered', 'Pacotes cadastrados','bar');

        return view('livewire.dashboard.home-component', compact('chartClients', 'chartRoutes', 'chartPackages'));
    }

    public function dataClientChart()
    {
        $labels = [];
        $data = [];
        $colors = '#' . substr(md5(mt_rand()), 0, 6);
        $clients = Client::selectRaw('DATE_FORMAT(created_at, "%d-%m-%Y") as date, count(*) as total')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        foreach ($clients as $client) {
            $labels[] = $client->date;
            $data[] = $client->total;
        }

        return [$labels, $data, $colors];
    }

    public function dataRouteChart()
    {
        $labels = [];
        $data = [];
        $colors = '#' . substr(md5(mt_rand()), 0, 6);
        $routes = Route::selectRaw('DATE_FORMAT(created_at, "%d-%m-%Y") as date, count(*) as total')
            ->where('place_id', Session::get('place_id'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        foreach ($routes as $route) {
            $labels[] = $route->date;
            $data[] = $route->total;
        }

        return [$labels, $data, $colors];
    }

    public function dataPackageChart()
    {
        $labels = [];
        $data = [];
        $colors = '#' . substr(md5(mt_rand()), 0, 6);
        $packages = Package::selectRaw('place_id as place, places.name as name, count(*) as total')
            ->join('places', 'packages.place_id', '=', 'places.id')
            ->groupBy('place')
            ->orderBy('place', 'asc')
            ->get();

        foreach ($packages as $package) {
            $labels[] = $package->name;
            $data[] = $package->total;
        }

        return [$labels, $data, $colors];
    }

    public function setChart($data, $name, $label, $type = 'bar')
    {
        $chart = app()->chartjs
        ->name($name)
        ->type($type)
        ->labels($data['0'])
        ->datasets([
            [
                "label" => $label,
                'backgroundColor' => $data['2'],
                'data' => $data['1'],
            ]
        ])
        ->options([]);

        return $chart;
    }
}
