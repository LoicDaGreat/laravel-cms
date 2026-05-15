<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait ProfileValidationRules
{
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?int $userId = null): array
    {
        return [
            'name' => $this->nameRules(),
            'email' => $this->emailRules($userId),
            'monthly_income' => $this->monthlyIncomeRules(),
            'currency_id' => $this->currencyRules(),
        ];
    }

    /**
     * Get the validation rules used to validate user names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function nameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate user emails.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?int $userId = null): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            $userId === null
                ? Rule::unique(User::class)
                : Rule::unique(User::class)->ignore($userId),
        ];
    }

    /**
     * Get the validation rules for monthly income.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function monthlyIncomeRules(): array
    {
        return ['nullable', 'numeric', 'min:0', 'max:99999999.99'];
    }

    /**
     * Get the validation rules for currency.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function currencyRules(): array
    {
        return ['nullable', 'integer', Rule::exists('currencies', 'id')];
    }
}
