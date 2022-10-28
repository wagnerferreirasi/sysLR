<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_methods')->insert([
            'name' => 'Dinheiro',
            'description' => 'Pagamento feito em dinheiro',
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Cartão de crédito',
            'description' => 'Pagamento feito com cartão de crédito',
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Cartão de débito',
            'description' => 'Pagamento feito com cartão de débito',
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Pix',
            'description' => 'Pagamento feito com Pix',
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Transferência bancária',
            'description' => 'Pagamento feito com transferência bancária',
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Boleto bancário',
            'description' => 'Pagamento feito com boleto bancário',
        ]);

        DB::table('payment_methods')->insert([
            'name' => 'Outros',
            'description' => 'Pagamento feito de outra forma ou pagamento na entrega',
        ]);
    }
}
