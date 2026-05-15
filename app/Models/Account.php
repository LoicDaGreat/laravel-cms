<?php

namespace App\Models;

use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'type', 'balance'])]
class Account extends Model
{
    public function casts(): array
    {
        return [
            'balance' => 'int',
            'type' => AccountType::class,
        ];
    }
}
