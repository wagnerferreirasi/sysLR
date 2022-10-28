<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'cpfcnpj' => fake()->numerify('###########'),
            'rg' => fake()->numerify('#########'),
            'address' => fake()->streetAddress,
            'number' => fake()->buildingNumber,
            'complement' => fake()->secondaryAddress,
            'district' => fake()->citySuffix,
            'city' => fake()->city,
            'state' => fake()->stateAbbr,
            'zip_code' => fake()->postcode,
        ];
    }
}
