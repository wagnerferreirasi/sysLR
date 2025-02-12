<?php

namespace App\Http\Livewire\Dashboard\Place;

use App\Models\Place;
use Livewire\Component;

class PlaceComponent extends Component
{
    public $places;

    public function mount()
    {
        $this->places = cache()->rememberForever('places', function () {
            return Place::where('active', 1)
                ->orderBy('name', 'asc')
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.dashboard.place.place-component');
    }
}
