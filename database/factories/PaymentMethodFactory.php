<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['Dinheiro', 'Cartão de Crédito', 'Cartão de Débito', 'Pix', 'Transferência Bancária'];

        foreach ($types as $type) {
            return [
                'name' => $type,
                'description' => $this->faker->sentence,
            ];
        }
    }
}
