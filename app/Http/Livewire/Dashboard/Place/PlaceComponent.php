<?php

namespace App\Http\Livewire\Dashboard\Place;

use App\Models\Place;
use Livewire\Component;

class PlaceComponent extends Component
{
    public $places;

    public function mount()
    {
        $this->places = Place::all();
    }

    public function render()
    {
        return view('livewire.dashboard.place.place-component');
    }
}
