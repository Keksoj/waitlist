<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscription;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->state(UserFactory::new()->doctorExample())
            ->has(Subscription::factory()->count(8))
            ->create();

        User::factory()->count(3)->has(Subscription::factory()->count(10))->create();
    }
}
