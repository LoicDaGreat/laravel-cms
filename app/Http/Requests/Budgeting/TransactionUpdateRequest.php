<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class TransactionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_id' => ['sometimes', 'integer', 'exists:accounts,id'],
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'amount' => ['sometimes', 'numeric', 'min:0.01'],
            'type' => ['sometimes', 'string', 'in:income,expense,transfer'],
            'date' => ['sometimes', 'date'],
            'note' => ['nullable', 'string', 'max:500'],
        ];
    }
}
