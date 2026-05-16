<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:100'],
            'type' => ['sometimes', 'string', 'in:checking,savings,credit,cash'],
            'balance' => ['sometimes', 'numeric', 'min:0'],
            'currency_id' => ['sometimes', 'integer', 'exists:currencies,id'],
        ];
    }
}
