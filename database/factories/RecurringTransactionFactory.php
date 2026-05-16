<?php

namespace Database\Factories;

use App\Enums\CategoryType;
use App\Models\Category;
use App\Models\RecurringTransaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RecurringTransactionFactory extends Factory
{
    protected $model = RecurringTransaction::class;

    public function definition(): array
    {
        $category = Category::where('type', CategoryType::EXPENSE)->get()->random();
        $frequencies = ['daily', 'weekly', 'monthly', 'yearly'];

        return [
            'user_id' => User::factory(),
            'category_id' => $category->id,
            'amount' => fake()->randomFloat(2, 50, 500),
            'frequency' => fake()->randomElement($frequencies),
            'next_due_date' => Carbon::now()->addDays(fake()->numberBetween(1, 30)),
        ];
    }
}
