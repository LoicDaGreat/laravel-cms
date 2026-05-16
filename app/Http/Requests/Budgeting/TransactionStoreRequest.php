<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'account_id' => ['required', 'integer', 'exists:accounts,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'type' => ['required', 'string', 'in:income,expense,transfer'],
            'date' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:500'],
        ];
    }
}
