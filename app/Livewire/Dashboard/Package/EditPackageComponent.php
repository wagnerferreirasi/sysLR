<?php

namespace App\Livewire\Dashboard\Package;

use App\Models\Package;
use Livewire\Component;

class EditPackageComponent extends Component
{
    public $package;
    public function render()
    {
        return view('livewire.dashboard.package.edit-package-component');
    }

    public function mount($id)
    {
        $this->package = Package::find($id);
    }

    public function update()
    {
        $this->validate([
            'package.code' => 'required',
            'package.user_id' => 'required',
            'package.place_id' => 'required',
            'package.destiny_id' => 'required',
            'package.client_id' => 'required',
        ]);

        $this->package->save();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'title' => 'Sucesso!',
            'message' => 'Pacote atualizado com sucesso!'
        ]);

        return redirect()->route('dashboard.packages');
    }
}
