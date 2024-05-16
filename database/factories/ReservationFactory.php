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
            'user_id' => 1360,
            'area_id' => function() {
                return Area::all()->random()->id;
            },
            'date' => '2024-05-14',
            'fee_log' => fake()->randomNumber(4),
            'deleted_at' => fake()->dateTimeBetween('2022-01-01', '2024-12-31'),
        ];
    }
}
