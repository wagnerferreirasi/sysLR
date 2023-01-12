<?php

namespace App\Http\Livewire\Dashboard\Package;

use App\Models\Sender;
use App\Models\Package;
use Livewire\Component;

class PackageComponent extends Component
{
    public $packages;

    protected $listeners = [
        'delete' => 'delete',
        'modalShow' => 'show',
        'modalDelete' => 'modalDelete',
    ];

    public function mount()
    {
        $this->packages = Package::all();
    }

    public function exportData()
    {
        return $this->packages;
    }

    public function delete($id)
    {
        try {
            $package = Package::find($id);

            if ($package->status == 'Created') {
                $package->delete();

                $this->dispatchBrowserEvent('hideModal');
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'title' => 'Sucesso!',
                    'message' => 'Pacote excluído com sucesso!'
                ]);

                return redirect()->route('dashboard.packages');
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'error',
                    'title' => 'Ops... Algo deu errado!',
                    'message' => 'Pacote não pode ser excluído! Status: ' . $package->status . '. Pacote em processo de envio ou já enviado não pode ser excluído.'
                ]);

                return redirect()->route('dashboard.packages');
            }


        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Ops... Algo deu errado!',
                'message' => 'Erro ao excluir pacote!' . $e->getMessage()
            ]);

            return redirect()->route('dashboard.packages');
        }
    }

    public function show($id)
    {
        $package = Package::find($id);
        $sender = Sender::find($package->sender_id);
        $this->dispatchBrowserEvent('showModal', ['package' => $package, 'sender' => $sender]);
    }

    public function modalDelete($id)
    {
        $this->dispatchBrowserEvent('modalDelete', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.dashboard.package.package-component');
    }
}
