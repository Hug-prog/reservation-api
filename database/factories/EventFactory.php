<?php

namespace Database\Factories;

use App\Models\Place;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            "name"=> fake()->name,
            "description"=>fake()->text,
            "nb_places"=>fake()->buildingNumber,
            "type_id"=>Type::factory()->create(["name"=>"théâtre"])->id,
        ];
    }
}
