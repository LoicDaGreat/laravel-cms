<?php

namespace App\Http\Requests\Budgeting;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:80'],
            'type' => ['sometimes', 'string', 'in:income,expense'],
            'icon' => ['nullable', 'string', 'max:50'],
            'color' => ['nullable', 'string', 'size:7'],
        ];
    }
}
