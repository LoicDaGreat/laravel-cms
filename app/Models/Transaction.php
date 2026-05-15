<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['amount', 'type', 'note'])]
class Transaction extends Model
{
    public function casts(): array
    {
        return [
            'amount' => 'float',
            'type' => TransactionType::class,
        ];
    }
}
