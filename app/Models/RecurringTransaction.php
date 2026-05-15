<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['amount', 'frequency', 'next_due_date'])]
class RecurringTransaction extends Model
{
    public function casts(): array
    {
        return [
            'amount' => 'float',
            'frequency' => Period::class,
        ];
    }
}
