<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Support\Helpers;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'telephone' => fake()->phoneNumber(),
            'email' => fake()->safeEmail(),
            'commentary' => fake()->sentence(),
            'cancellation_code' => Helpers::randomString(),
            'user_id' => User::factory(),
        ];
    }
}
