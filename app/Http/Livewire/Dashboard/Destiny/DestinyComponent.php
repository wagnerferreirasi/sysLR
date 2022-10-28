<?php

namespace App\Http\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;

class DestinyComponent extends Component
{
    public function mount()
    {
        $this->destinies = Destiny::all();
    }

    public function render()
    {
        return view('livewire.dashboard.destiny.destiny-component');
    }
}
