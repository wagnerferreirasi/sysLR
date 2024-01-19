<?php

namespace App\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;

class DestinyComponent extends Component
{
    protected $listeners = [
        'delete' => 'delete',
    ];

    public $destinies;

    public function mount()
    {
        $this->destinies = Destiny::orderBy('state', 'asc')->get();
    }

    public function delete($id)
    {
        try {
            $destiny = Destiny::find($id);
            $destiny->delete();

            $this->dispatch('hideModal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'title' => 'Sucesso!',
                'message' => 'Destino excluído com sucesso!'
            ]);

            $this->destinies = Destiny::orderBy('state', 'asc')->get();


        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Ops... Algo deu errado!',
                'message' => 'Erro ao excluir destino!' . $e->getMessage()
            ]);

            return redirect()->route('dashboard.destinies');
        }
    }

    public function show($id)
    {
        $destinyShow = Destiny::find($id);
        $this->dispatch('showModal', ['destinyShow' => $destinyShow]);
    }

    public function modalDelete($id)
    {
        $destiny = Destiny::find($id);
        $this->dispatch('modalDelete', ['destinyDelete' => $destiny]);
    }

    public function render()
    {
        return view('livewire.dashboard.destiny.destiny-component');
    }
}
