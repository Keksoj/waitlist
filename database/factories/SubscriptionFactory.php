<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Str;
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
            'cancellation_code' => Str::random(7), // TODO: use SubscriptionController::randomString
            'user_id' => User::factory(),
        ];
    }
}
