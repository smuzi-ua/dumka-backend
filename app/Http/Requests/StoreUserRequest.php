<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required'
            ],
            'slug' => [
                'string',
                'required',
                Rule::unique('users')
                    ->where('school_id', $this->school_id)
            ],
        ];
    }
}
