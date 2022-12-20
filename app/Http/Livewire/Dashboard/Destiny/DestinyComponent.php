<?php

namespace App\Http\Livewire\Dashboard\Destiny;

use App\Models\Destiny;
use Livewire\Component;

class DestinyComponent extends Component
{
    protected $listeners = [
        'delete' => 'delete',
    ];

    public function mount()
    {
        $this->destinies = Destiny::all();
    }

    public function delete($id)
    {
        try {
            $destiny = Destiny::find($id);
            $destiny->delete();

            $this->dispatchBrowserEvent('hideModal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'title' => 'Sucesso!',
                'message' => 'Destino excluído com sucesso!'
            ]);

            $this->destinies = Destiny::all();


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
        $this->dispatchBrowserEvent('showModal', ['destinyShow' => $destinyShow]);
    }

    public function modalDelete($id)
    {
        $destiny = Destiny::find($id);
        $this->dispatchBrowserEvent('modalDelete', ['destinyDelete' => $destiny]);
    }

    public function render()
    {
        return view('livewire.dashboard.destiny.destiny-component');
    }
}
