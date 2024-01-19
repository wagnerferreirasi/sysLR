<?php

namespace App\Livewire\Dashboard\Cashier;

use PDF;
use App\Models\Cashier;
use Livewire\Component;
use App\Models\CashMovement;
use App\Models\Password;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class CashierComponent extends Component
{
    public mixed $cashier;
    public $movements;
    public $value;
    public $description;
    public $type;
    public $paymentMethod;
    public $paymentMethods;
    public $amount;
    public $password;
    public $state = [];

    public function mount(): void
    {
        $this->cashier = Cashier::where('user_id', auth()->user()->id)
            ->where('place_id', session()->get('place_id'))
            ->orderBy('id', 'desc')
            ->first();
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


        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Caixa aberto com sucesso!'
        ]);

        return $this->redirect(route('dashboard.cashiers'));
    }

    public function closeCashier()
    {
        $this->cashier->update([
            'status' => 'close',
        ]);

        $this->dispatch('alert', [
            'type' => 'success',
            'message' => 'Caixa fechado com sucesso!'
        ]);

        return $this->redirect(route('dashboard.cashiers'));
    }

    public function exportData()
    {
        $cashier = $this->cashier;
        $movements = $this->movements;

        $pdfContent = PDF::loadView('livewire.dashboard.cashier.cashier-component', [
            'movements'=>$movements,
            'cashier'=>$cashier
        ])->output();

        return response()->streamDownload(
            fn () => print($pdfContent),
            "movimentacoes.pdf"
        );

    }

    public function withdrawal()
    {
        if($this->passwordCheck($this->password)) {
            //faz a retirada e lança o movimento no caixa
            $moviment = CashMovement::create([
                'cashier_id' => $this->cashier->id,
                'user_id' => auth()->user()->id,
                'payment_method_id' => 1,
                'type' => 'OUT',
                'value' => $this->state['value'],
                'description' => 'Retirada de dinheiro',
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Retirada efetuada com sucesso!'
            ]);

            return $this->redirect(route('dashboard.cashiers'));

        }

        $this->dispatch('alert', [
            'type' => 'error',
            'message' => 'Senha inválida!'
        ]);
    }

    public function passwordCheck($password)
    {
        $modelPass = Password::where('password', $password)
                                ->first();

        //dd($modelPass);

        if (isNull($modelPass)) {
            return false;
        }

        return true;

    }

    public function render()
    {
        if ($this->cashier) {
            $this->movements = CashMovement::where('user_id', auth()->user()->id)
                ->where('cashier_id', $this->cashier->id)
                ->get();

            $this->amount = $this->cashier->amount();

        }

        $amount = $this->amount;

        $this->paymentMethods = PaymentMethod::where('name', 'Dinheiro')->get();

        return view('livewire.dashboard.cashier.cashier-component', compact('amount'));
    }
}
