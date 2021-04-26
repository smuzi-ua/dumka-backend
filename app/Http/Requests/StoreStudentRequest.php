<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'slug' => ['string', 'required', 'unique:users,slug'],
        ];
    }
}