<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class BudgetStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'period' => ['required', 'string', 'in:weekly,monthly,yearly'],
            'start_date' => ['required', 'date'],
        ];
    }
}
