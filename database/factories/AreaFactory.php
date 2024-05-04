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
            'attribute_id' => Attribute::factory(),
            'fee_id' => Fee::factory(),
            'address' => fake()->address,
            'max_num' => fake()->numberBetween(1, 50),
        ];
    }
}
