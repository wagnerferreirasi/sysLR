<?php

namespace App\Http\Livewire\Dashboard\Cashier;

use App\Models\Cashier;
use Livewire\Component;
use PDF;
use App\Models\CashMovement;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Termwind\render;

class CashierComponent extends Component
{
    public $cashier;
    public $movements;
    public $value;
    public $description;
    public $type;
    public $paymentMethod;
    public $paymentMethods;
    public $amount;
    public $state = [];

    public function mount()
    {
        $this->cashier = Cashier::where('user_id', auth()->user()->id)->where('place_id', session()->get('place_id'))->orderBy('id', 'desc')->first();

        if ($this->cashier) {
            $this->movements = CashMovement::where('user_id', auth()->user()->id)->where('cashier_id', $this->cashier->id)->get();
            $this->amount = $this->cashier->amount();
        }

        $this->paymentMethods = PaymentMethod::all();
    }

    public function openCashier()
    {
        Validator::make($this->state, [
            'value' => 'required|numeric',
            'description' => 'required',
            'type' => 'required',
            'paymentMethod' => 'required',
        ],[
            'value.required' => 'O valor é obrigatório',
            'value.numeric' => 'O valor deve ser numérico',
            'description.required' => 'A descrição é obrigatória',
            'type.required' => 'O tipo de movimentação é obrigatório',
            'paymentMethod.required' => 'O método de pagamento é obrigatório',
        ]);

        DB::transaction(function () {
            $cashier = Cashier::create([
                'user_id' => auth()->user()->id,
                'place_id' => session()->get('place_id'),
                'status' => 'open',
            ]);

            CashMovement::create([
                'cashier_id' => $cashier->id,
                'user_id' => auth()->user()->id,
                'payment_method_id' => $this->state['paymentMethod'],
                'type' => $this->state['type'],
                'value' => $this->state['value'],
                'description' => $this->state['description'],
            ]);
        });


        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Caixa aberto com sucesso!'
        ]);
        return $this->render();
    }

    public function closeCashier()
    {
        $this->cashier->update([
            'status' => 'close',
        ]);
        return redirect()->route('dashboard.cashiers');
    }

    public function exportData()
    {
        $cashier = $this->cashier;
        $movements = $this->movements;

        $pdfContent = PDF::loadView('livewire.dashboard.cashier.cashier-component', ['movements'=>$movements, 'cashier'=>$cashier])->output();
        return response()->streamDownload(
            fn () => print($pdfContent),
            "movimentacoes.pdf"
        );

    }

    public function render()
    {
        return view('livewire.dashboard.cashier.cashier-component');
    }
}
