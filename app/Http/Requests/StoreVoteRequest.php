<?php

namespace App\Http\Requests;

use App\Enums\VoteType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                Rule::in(VoteType::UPVOTE, VoteType::DOWNVOTE),
            ],
        ];
    }
}
