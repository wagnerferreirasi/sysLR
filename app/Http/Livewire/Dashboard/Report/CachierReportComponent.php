<?php

namespace App\Http\Livewire\Dashboard\Report;

use App\Models\Place;
use App\Libs\ExportLib;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\DatatableModel;
use Illuminate\Support\Facades\Cache;

class CachierReportComponent extends Component
{
    public $cashierReports;
    public $datatable;
    public $places;
    public $count;

    public function render()
    {
        $this->places = Cache::rememberForever('places', function () {
            return Place::all();
        });

        return view('livewire.dashboard.report.cachier-report-component');
    }

    public function getData() {
        $requestData = $_REQUEST;

        $this->datatable = new DatatableModel('cash_movements');

        $datatable = $this->datatable;
        $this->cashierReports = $datatable->select(['cashiers.id', 'cash_movements.id', 'users.name as userName', 'places.name as placeName', 'cash_movements.value as value', 'cash_movements.created_at as date']);

        $this->cashierReports = $datatable->setJoin('cashiers', 'cash_movements.cashier_id', '=', 'cashiers.id', 'left');
        $this->cashierReports = $datatable->setJoin('users', 'cash_movements.user_id', '=', 'users.id', 'left');
        $this->cashierReports = $datatable->setJoin('places', 'cashiers.place_id', '=', 'places.id', 'left');

        $this->cashierReports = $datatable->setWhere('cash_movements.type', '=', 'in');

        if ($requestData['dateStart'] != '')
            $this->cashierReports = $datatable->setWhere('cash_movements.created_at', '>=', $requestData['dateStart']);

        if ($requestData['dateEnd'] != '')
            $this->cashierReports = $datatable->setWhere('cash_movements.created_at', '<=', $requestData['dateEnd']);

        if ($requestData['placeId'] != '')
            $this->cashierReports = $datatable->setWhere('cashiers.place_id', '=', $requestData['placeId']);

        $this->cashierReports = $datatable->setOrder('cash_movements.created_at', 'desc');

        $this->cashierReports = $datatable->setOffset($requestData['length'], $requestData['start']);

        $this->cashierReports = $datatable->getData();

        $this->count = $datatable->countTotal();

        return response()->json(
            [
                'draw' => $requestData['draw'],
                'data' => $this->cashierReports,
                'recordsTotal' => $this->count,
                'recordsFiltered' => $this->count,
            ]
        );
    }

    public function exportData()
    {
        $fields = [
            'Id',
            'Usuário',
            'Local',
            'Valor',
            'Data',
        ];

        $rows = [];
        foreach ($this->cashierReports as $data) {
            $rows[] = [
                $data->id,
                $data->userName,
                $data->placeName,
                $data->value,
                $data->date,
            ];
        }

        ExportLib::export('Relatório de Caixa', $fields, $rows);
    }
}
