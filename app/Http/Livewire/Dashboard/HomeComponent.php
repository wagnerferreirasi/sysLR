<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Route;
use App\Models\Client;
use App\Models\Package;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeComponent extends Component
{

    public function render()
    {
        return view('livewire.dashboard.home-component');
    }
}
