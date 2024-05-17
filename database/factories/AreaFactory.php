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
            'name' => fake()->unique()->randomElement(["Area A, 1F", "Area B, 1F", "Area C, 1F", "Area B, 2F"]),
            // 'name' => "Area C, 1F",
            // 'attribute_id' => function() {
            //     return Attribute::all()->random()->id;
            // },
            'attribute_id' => fake()->numberBetween(4, 9),
            'fee_id' => function() {
                return Fee::all()->random()->id;
            },
            'address' => "123 Main Street Anytown",
            'max_num' => fake()->numberBetween(1, 50),
        ];
    }
}
