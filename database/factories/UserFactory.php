<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Attribute;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'phone_number' => fake()->phoneNumber(),
            'plate_number' => fake()->regexify('[A-Z]{3}-[0-9]{3}'),
            'attribute_id' => function() {
                return Attribute::all()->random()->id;
            },
            'created_at' => fake()->dateTimeBetween('2023-01-01', '2023-12-31'),
            // 'deleted_at' => fake()->dateTimeBetween('2024-01-01', '2024-12-31'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
