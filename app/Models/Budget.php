<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['amount', 'period', 'start_date'])]
class Budget extends Model
{
    public function casts(): array
    {
        return [
            'amount' => 'float',
            'period' => Period::class,
        ];
    }
}
