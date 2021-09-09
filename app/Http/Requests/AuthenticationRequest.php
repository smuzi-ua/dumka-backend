<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class AuthenticationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'string',
            ],
            'slug' => [
                'string',
                'required',
                Rule::unique('users')->where('school_id', $this->school_id)
            ],
        ];
    }
}
