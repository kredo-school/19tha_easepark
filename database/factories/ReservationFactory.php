<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Area;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function() {
                return User::all()->random()->id;
            },
            'area_id' => function() {
                return Area::all()->random()->id;
            },
            'date' => fake()->date(),
            'fee_log' => fake()->randomNumber(4),
        ];
    }
}