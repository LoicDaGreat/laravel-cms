<?php

namespace App\Models;

use App\Enums\Period;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'category_id', 'amount', 'period', 'start_date'])]
class Budget extends Model
{
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'period' => Period::class,
            'start_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
