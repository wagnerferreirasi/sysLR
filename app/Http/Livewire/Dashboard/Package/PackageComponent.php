<?php

namespace App\Http\Livewire\Dashboard\Package;

use App\Models\Package;
use Livewire\Component;

class PackageComponent extends Component
{
    public $packages;

    public function mount()
    {
        $this->packages = Package::all();
    }

    public function exportData()
    {
        return $this->packages;
    }

    public function render()
    {
        return view('livewire.dashboard.package.package-component');
    }
}
