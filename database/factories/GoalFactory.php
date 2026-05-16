<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GoalFactory extends Factory
{
    protected $model = Goal::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->sentence(3),
            'target_amount' => fake()->randomFloat(2, 1000, 20000),
            'saved_amount' => fake()->randomFloat(2, 0, 5000),
            'deadline' => Carbon::now()->addMonths(fake()->numberBetween(3, 24)),
            'status' => fake()->randomElement(Status::cases()),
        ];
    }
}
