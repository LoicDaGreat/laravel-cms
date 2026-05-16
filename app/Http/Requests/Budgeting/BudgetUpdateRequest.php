<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class BudgetUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'amount' => ['sometimes', 'numeric', 'min:0.01'],
            'period' => ['sometimes', 'string', 'in:weekly,monthly,yearly'],
            'start_date' => ['sometimes', 'date'],
        ];
    }
}
