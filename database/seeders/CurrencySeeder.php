<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            ['code' => 'USD', 'name' => 'US Dollar', 'symbol' => '$'],
            ['code' => 'EUR', 'name' => 'Euro', 'symbol' => '€'],
            ['code' => 'GBP', 'name' => 'British Pound', 'symbol' => '£'],
            ['code' => 'ZAR', 'name' => 'South African Rand', 'symbol' => 'R'],
            ['code' => 'AUD', 'name' => 'Australian Dollar', 'symbol' => 'A$'],
            ['code' => 'CAD', 'name' => 'Canadian Dollar', 'symbol' => 'C$'],
            ['code' => 'JPY', 'name' => 'Japanese Yen', 'symbol' => '¥'],
            ['code' => 'INR', 'name' => 'Indian Rupee', 'symbol' => '₹'],
        ];

        foreach ($currencies as $currency) {
            Currency::firstOrCreate(['code' => $currency['code']], $currency);
        }
    }
}
