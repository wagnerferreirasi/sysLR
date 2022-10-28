<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Destiny;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'place_id' => Place::all()->random()->id,
            'destiny_id' => Destiny::all()->random()->id,
            'price1' => fake()->randomFloat(2, 100, 1000),
            'price2' => fake()->randomFloat(2, 100, 1000),
            'price3' => fake()->randomFloat(2, 100, 1000),
            'status' => fake()->boolean,
        ];
    }
}
