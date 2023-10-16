<?php

namespace App\Http\Livewire\Dashboard\Package;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NewPackageComponent extends Component
{
    public $lrCode;
    public $client;
    public $sender;
    public $destiny;
    public $weight;
    public $width;
    public $length;
    public $height;
    public $observation;
    public $paymentMethod;
    public $value;
    public $rules = [
        'sender' => 'required',
        'client' => 'required',
        'destiny' => 'required',
        'weight' => 'required:number',
        'width' => 'required:number',
        'length' => 'required:number',
        'height' => 'required:number',
    ], $message = [
        'sender.required' => 'O remetente é obrigatório',
        'client.required' => 'O cliente é obrigatório',
        'destiny.required' => 'O destino é obrigatório',
        'weight.required' => 'O peso é obrigatório',
        'weight.number' => 'O peso deve ser um número',
        'width.required' => 'A largura é obrigatória',
        'width.number' => 'A largura deve ser um número',
        'length.required' => 'O comprimento é obrigatório',
        'length.number' => 'O comprimento deve ser um número',
        'height.required' => 'A altura é obrigatória',
        'height.number' => 'A altura deve ser um número',
    ];

    protected $listeners = [
        'loading' => 'loading',
        'calculateValue' => 'calculateValue',
    ];

    public function loading()
    {
        $this->dispatchBrowserEvent('alert', ['type' => 'info',  'message' => 'Carregando valor e formas de pagamento...']);
        return $this->calculateValue();
    }


    public function render()
    {
        $lrCode = "LR" . date('Ymd') . "_" . rand(000000, 999999);
        $this->lrCode = $lrCode;
        $clients = cache()->rememberForever('clients', function () {
            return Client::where('type', 'client')->get();
        });

        $senders = cache()->rememberForever('senders', function () {
            return Client::where('type', 'company')->get();
        });

        $destinies = cache()->rememberForever('destinies', function () {
            return DB::table('routes')
                ->join('destinies', 'routes.destiny_id', '=', 'destinies.id')
                ->select('destinies.*')
                ->where('routes.place_id', session()->get('place_id'))
                ->where('routes.status', 1)
                ->get();
        });
        return view('livewire.dashboard.package.new-package-component', compact('lrCode', 'clients', 'destinies', 'senders'));
    }

    public function store()
    {
        $this->validate($this->rules, $this->message);

        DB::beginTransaction();
        try {
            $package = DB::table('packages')->insertGetId([
                'code' => $this->lrCode,
                'user_id' => auth()->user()->id,
                'sender_id' => $this->sender,
                'client_id' => $this->client,
                'place_id' => session()->get('place_id'),
                'destiny_id' => $this->destiny,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $packageItem = DB::table('package_items')->insert([
                'package_id' => $package,
                'value' => $this->value,
                'payment_method_id' => $this->paymentMethod == 0 ? 7 : $this->paymentMethod,
                'pay_on_delivery' => $this->paymentMethod == 0 ? 1 : 0,
                'weight' => $this->weight,
                'width' => $this->width,
                'height' => $this->height,
                'length' => $this->length,
                'observations' => $this->observation,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $cashier_id = DB::table('cashiers')
                ->where('place_id', session()->get('place_id'))
                ->where('user_id', auth()->user()->id)
                ->where('status', 1)
                ->first();

            $movementCash = DB::table('cash_movements')->insert([
                'cashier_id' => $cashier_id->id,
                'user_id' => auth()->user()->id,
                'payment_method_id' => $this->paymentMethod == 0 ? 7 : $this->paymentMethod,
                'type' => 'in',
                'value' => $this->value,
                'description' => 'Entrada referente ao pacote ' . $this->lrCode,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            session()->flash('message', 'Pacote cadastrado com sucesso!');
            return redirect()->route('dashboard.packages');
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('message', 'Erro ao cadastrar pacote! Tente novamente mais tarde.');
            return redirect()->route('dashboard.packages');
        }
    }

    public function calculateValue()
    {
        $amount = DB::table('routes')->select('id', 'price1', 'price2', 'price3', 'tax')->where([
            ['place_id', session()->get('place_id')],
            ['destiny_id', $this->destiny]
        ])->where('status', 1)->get()->first();

        $area = $this->length * $this->weight * $this->width;

        if ($area <= 125000) {
            $this->value = $amount->price1;
        } elseif ($area >= 125001 and $area <= 512000) {
            $this->value = $amount->price2;
        } else {
            $this->value = $amount->price3;
            if ($area > 1728000) {
                $newMeasures = $area - 1728000;
                $additional = $newMeasures / 1000 / 100 * $amount->tax;
                is_numeric($additional);
                $this->value = $additional + $this->value;
            }
        }
        $this->dispatchBrowserEvent('value', ['value' => $this->value]);
        $this->dispatchBrowserEvent('openModal');
        return $this->value;
    }

    public function floatToDecimal($value)
    {
        $value = str_replace(',', '.', $value);
        return $value;
    }

    public function decimalToFloat($value)
    {
        $value = str_replace('.', ',', $value);
        return $value;
    }
}
