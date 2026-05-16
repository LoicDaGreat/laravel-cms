<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class RecurringTransactionUpdateRequest extends FormRequest
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
            'frequency' => ['sometimes', 'string', 'in:daily,weekly,monthly,yearly'],
            'next_due_date' => ['sometimes', 'date'],
        ];
    }
}
