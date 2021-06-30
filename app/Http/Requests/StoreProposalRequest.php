<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreProposalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'body'  => 'required|string',
        ];
    }
}
