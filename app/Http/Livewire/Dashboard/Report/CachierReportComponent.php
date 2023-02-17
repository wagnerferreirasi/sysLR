<?php

namespace App\Http\Livewire\Dashboard\Report;

use Livewire\Component;
use App\Models\DatatableModel;
use App\Models\Place;

class CachierReportComponent extends Component
{
    public $cashierReports;
    public $datatable;
    public $dateStart;
    public $dateEnd;
    public $placeId;
    public $places;

    public function mount()
    {
        $this->places = Place::all();
        $this->datatable = new DatatableModel('cash_movements');
    }

    public function render()
    {
        $datatable = $this->datatable;
        $this->cashierReports = $datatable->select(['cashiers.id', 'cash_movements.id', 'users.name as userName', 'places.name as placeName', 'cash_movements.value as value', 'cash_movements.created_at as date']);
        $this->cashierReports = $datatable->setJoin('cashiers', 'cash_movements.cashier_id', '=', 'cashiers.id');
        $this->cashierReports = $datatable->setJoin('users', 'cash_movements.user_id', '=', 'users.id');
        $this->cashierReports = $datatable->setJoin('places', 'cashiers.place_id', '=', 'places.id');
        $this->cashierReports = $datatable->setWhere('cash_movements.type', '=', 'in');

        if ($this->dateStart)
            $this->cashierReports = $datatable->setWhere('cash_movements.created_at', '>=', $this->dateStart);

        if ($this->dateEnd)
            $this->cashierReports = $datatable->setWhere('cash_movements.created_at', '<=', $this->dateEnd);

        if ($this->placeId)
            $this->cashierReports = $datatable->setWhere('cashiers.place_id', '=', $this->placeId);

        $this->cashierReports = $datatable->getData();

        return view('livewire.dashboard.report.cachier-report-component');
    }
}
