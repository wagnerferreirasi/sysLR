<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Loja_' . fake()->numerify(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'cnpj' => '00.000.000/0000-00',
            'zipcode' => fake()->postcode(),
            'address' => fake()->address(),
            'number' => fake()->buildingNumber(),
            'complement' => fake()->optional()->secondaryAddress(),
            'district' => fake()->name(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'active' => true,
        ];
    }
}
