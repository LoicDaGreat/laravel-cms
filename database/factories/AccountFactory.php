<?php

namespace Database\Factories;

use App\Enums\AccountType;
use App\Models\Accounts;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    protected $model = Accounts::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'type' => fake()->randomElement(AccountType::cases()),
            'balance' => fake()->randomFloat(2, 100, 10000),
            'currency_id' => 1,
        ];
    }
}
