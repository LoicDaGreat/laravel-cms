<?php

namespace Database\Factories;

use App\Enums\TransactionType;
use App\Models\Accounts;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        $type = fake()->randomElement(TransactionType::cases());
        $categories = Category::where('type', $type === TransactionType::TRANSFER ? 'expense' : $type->value)->get();

        return [
            'user_id' => User::factory(),
            'account_id' => Accounts::factory(),
            'category_id' => $categories->random()->id,
            'amount' => fake()->randomFloat(2, 10, 1000),
            'type' => $type,
            'note' => fake()->sentence(3),
            'date' => Carbon::now()->subDays(fake()->numberBetween(0, 30)),
        ];
    }
}
