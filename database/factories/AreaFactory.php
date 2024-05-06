<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attribute;
use App\Models\Fee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'attribute_id' => function() {
                return Attribute::all()->random()->id;
            },
            'fee_id' => function() {
                return Fee::all()->random()->id;
            },
            'address' => fake()->address,
            'max_num' => fake()->numberBetween(1, 50),
        ];
    }
}
