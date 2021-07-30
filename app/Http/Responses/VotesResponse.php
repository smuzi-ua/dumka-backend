<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

final class VotesResponse implements Responsable
{
    public function __construct(
        public int $upVotes,
        public int $downVotes,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'upvotes_count'   => $this->upVotes,
            'downvotes_count' => $this->downVotes,
        ]);
    }
}
