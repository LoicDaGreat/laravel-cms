<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class GoalUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:150'],
            'target_amount' => ['sometimes', 'numeric', 'min:0.01'],
            'saved_amount' => ['sometimes', 'numeric', 'min:0'],
            'deadline' => ['nullable', 'date', 'after:today'],
            'status' => ['sometimes', 'integer', 'in:1,2,3'],
        ];
    }
}
