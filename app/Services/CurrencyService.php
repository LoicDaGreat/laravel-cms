<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyService
{
    /**
     * Get all currencies.
     */
    public function getAll(): Collection
    {
        return Currency::orderBy('name')->get();
    }

    /**
     * Get a single currency by ID.
     */
    public function getById(int $id): Currency
    {
        return Currency::findOrFail($id);
    }
}
