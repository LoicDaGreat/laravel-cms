<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // Income categories
            ['name' => 'Salary', 'type' => CategoryType::INCOME, 'icon' => 'briefcase', 'color' => '#22C55E', 'is_default' => true],
            ['name' => 'Freelance', 'type' => CategoryType::INCOME, 'icon' => 'laptop', 'color' => '#10B981', 'is_default' => true],
            ['name' => 'Investments', 'type' => CategoryType::INCOME, 'icon' => 'trending-up', 'color' => '#14B8A6', 'is_default' => true],
            ['name' => 'Gifts', 'type' => CategoryType::INCOME, 'icon' => 'gift', 'color' => '#0D9488', 'is_default' => true],
            ['name' => 'Other Income', 'type' => CategoryType::INCOME, 'icon' => 'plus-circle', 'color' => '#0F766E', 'is_default' => true],

            // Expense categories
            ['name' => 'Groceries', 'type' => CategoryType::EXPENSE, 'icon' => 'shopping-cart', 'color' => '#EF4444', 'is_default' => true],
            ['name' => 'Rent/Mortgage', 'type' => CategoryType::EXPENSE, 'icon' => 'home', 'color' => '#F97316', 'is_default' => true],
            ['name' => 'Utilities', 'type' => CategoryType::EXPENSE, 'icon' => 'zap', 'color' => '#F59E0B', 'is_default' => true],
            ['name' => 'Transport', 'type' => CategoryType::EXPENSE, 'icon' => 'car', 'color' => '#EAB308', 'is_default' => true],
            ['name' => 'Dining Out', 'type' => CategoryType::EXPENSE, 'icon' => 'utensils', 'color' => '#84CC16', 'is_default' => true],
            ['name' => 'Entertainment', 'type' => CategoryType::EXPENSE, 'icon' => 'film', 'color' => '#22C55E', 'is_default' => true],
            ['name' => 'Healthcare', 'type' => CategoryType::EXPENSE, 'icon' => 'heart', 'color' => '#EC4899', 'is_default' => true],
            ['name' => 'Insurance', 'type' => CategoryType::EXPENSE, 'icon' => 'shield', 'color' => '#8B5CF6', 'is_default' => true],
            ['name' => 'Education', 'type' => CategoryType::EXPENSE, 'icon' => 'book-open', 'color' => '#6366F1', 'is_default' => true],
            ['name' => 'Subscriptions', 'type' => CategoryType::EXPENSE, 'icon' => 'repeat', 'color' => '#3B82F6', 'is_default' => true],
            ['name' => 'Clothing', 'type' => CategoryType::EXPENSE, 'icon' => 'shirt', 'color' => '#0EA5E9', 'is_default' => true],
            ['name' => 'Personal Care', 'type' => CategoryType::EXPENSE, 'icon' => 'user', 'color' => '#0284C7', 'is_default' => true],
            ['name' => 'Savings', 'type' => CategoryType::EXPENSE, 'icon' => 'piggy-bank', 'color' => '#0369A1', 'is_default' => true],
            ['name' => 'Miscellaneous', 'type' => CategoryType::EXPENSE, 'icon' => 'more-horizontal', 'color' => '#075985', 'is_default' => true],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name'], 'is_default' => true], $category);
        }
    }
}
