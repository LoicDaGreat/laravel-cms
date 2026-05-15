<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'type', 'balance'])]
class Accounts extends Model
{
    public function casts(): array
    {
        return [
            'balance' => 'int',
        ];
    }
}
