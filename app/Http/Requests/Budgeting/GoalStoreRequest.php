<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class GoalStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'target_amount' => ['required', 'numeric', 'min:0.01'],
            'saved_amount' => ['nullable', 'numeric', 'min:0'],
            'deadline' => ['nullable', 'date', 'after:today'],
        ];
    }
}
