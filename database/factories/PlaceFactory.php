<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            "country" => fake()->country,
            "city" => fake()->city,
            "street_number" => fake()->buildingNumber,
            "street" => fake()->streetName,
        ];
    }
}
