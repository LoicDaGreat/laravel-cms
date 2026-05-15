<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'target_amount', 'saved_amount', 'deadline', 'status'])]
class Goal extends Model
{
    public function casts(): array
    {
        return [
            'status' => Status::class,
            'saved_amount' => 'float',
            'target_amount' => 'float',
        ];
    }
}
