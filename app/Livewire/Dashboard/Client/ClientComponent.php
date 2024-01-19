<?php

namespace App\Livewire\Dashboard\Client;

use PDF;
use App\Models\Client;
use Livewire\Component;


class ClientComponent extends Component
{
    public $clients;

    public function mount()
    {
        $this->clients = cache()->rememberForever('clients', function () {
            return Client::all();
        });
    }

    public function exportData()
    {
        $clients = Client::orderBy('id', 'DESC')->get();

        $pdfContent = PDF::loadView('export.exportClients', ['clients' => $clients])->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "clientes.pdf"
        );

        $this->dispatch('alert', ['type' => 'success', 'message' => 'Dados exportados com sucesso!']);
    }

    public function delete($id = null)
    {
        try {
            $client = Client::find($id);
            $client->delete();

            $this->dispatch('hideModal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'title' => 'Sucesso!',
                'message' => 'Cliente excluído com sucesso!'
            ]);

            $this->render();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'title' => 'Ops... Algo deu errado!',
                'message' => 'Erro ao excluir cliente!' . $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $client = Client::find($id);
        $this->dispatch('showModal', ['client' => $client]);
    }

    public function render()
    {
        return view('livewire.dashboard.client.client-component');
    }
}
