<?php

namespace Database\Factories;

use FontLib\Table\Type\name;
use Illuminate\Database\Eloquent\Factories\Factory;
use Svg\Tag\Circle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destiny>
 */
class DestinyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $destiny = fake()->city;

        return [
            'name' => $destiny,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'city' => $destiny,
            'state' => fake()->stateAbbr,

        ];
    }
}
