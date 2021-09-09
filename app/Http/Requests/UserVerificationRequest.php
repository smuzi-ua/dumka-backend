<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $verification_code
 * @property string $slug
 */
final class UserVerificationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'verification_code' => 'required|string',
            'slug' => 'required|string'
        ];
    }
}
