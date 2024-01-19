<?php

namespace App\Livewire\Dashboard\Package;

use PDF;
use App\Models\Sender;
use App\Models\Package;
use Livewire\Component;
use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\DB;

class PackageComponent extends Component
{
    public $packages;
    public $print;

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
        $packages = Package::orderBy('id', 'DESC')->get();

        $pdfContent = PDF::loadView('export.exportPackages', ['packages' => $packages])->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "packages.pdf"
        );

        $this->dispatch('alert', ['type' => 'success', 'message' => 'Dados exportados com sucesso!']);
    }

    public function delete($id)
    {
        try {
            $package = Package::find($id);

            if ($package->status == 'Created') {
                $package->delete();

                $this->dispatch('hideModal');
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
        $package = DB::table('packages')
            ->join('senders', 'packages.sender_id', '=', 'senders.id')
            ->join('clients', 'packages.client_id', '=', 'clients.id')
            ->join('destinies', 'packages.destiny_id', '=', 'destinies.id')
            ->join('package_items', 'packages.id', '=', 'package_items.package_id')
            ->join('payment_methods', 'package_items.payment_method_id', '=', 'payment_methods.id')
            ->select('packages.*', 'senders.name as sender_name', 'senders.phone as sender_phone', 'senders.email as sender_email', 'senders.document as sender_document', 'clients.name as client_name', 'clients.phone as client_phone', 'clients.email as client_email', 'clients.cpfCnpj as client_cpf', 'clients.zip_code as client_cep', 'clients.address as client_address', 'clients.number as client_number', 'clients.complement as client_complement', 'clients.district as client_district', 'clients.city as client_city', 'clients.state as client_state', 'destinies.name as destiny_name', 'payment_methods.name as payment_method_name', 'package_items.value', 'package_items.weight', 'package_items.width', 'package_items.height', 'package_items.length', 'package_items.observations', 'package_items.pay_on_delivery')
            ->where('packages.id', $id)
            ->first();

        $this->dispatch('showModal', ['package' => $package]);
    }

    public function print($id)
    {
        $package = DB::table('packages')
            ->join('senders', 'packages.sender_id', '=', 'senders.id')
            ->join('clients', 'packages.client_id', '=', 'clients.id')
            ->join('destinies', 'packages.destiny_id', '=', 'destinies.id')
            ->join('package_items', 'packages.id', '=', 'package_items.package_id')
            ->join('payment_methods', 'package_items.payment_method_id', '=', 'payment_methods.id')
            ->select('packages.*', 'senders.name as sender_name', 'senders.phone as sender_phone', 'senders.email as sender_email', 'senders.document as sender_document', 'clients.name as client_name', 'clients.phone as client_phone', 'clients.email as client_email', 'clients.cpfCnpj as client_cpf', 'clients.zip_code as client_cep', 'clients.address as client_address', 'clients.number as client_number', 'clients.complement as client_complement', 'clients.district as client_district', 'clients.city as client_city', 'clients.state as client_state', 'destinies.name as destiny_name', 'package_items.payment_method_id', 'payment_methods.name as payment_method_name', 'package_items.value', 'package_items.weight', 'package_items.width', 'package_items.height', 'package_items.length', 'package_items.observations', 'package_items.pay_on_delivery')
            ->where('packages.id', $id)
            ->first();
            session(['package' => $package]);

        return redirect('/print');
    }

    public function getQrCode($code)
    {
        return QRCode::text($code)->png();
    }

    public function modalDelete($id)
    {
        $this->dispatch('modalDelete', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.dashboard.package.package-component');
    }
}
