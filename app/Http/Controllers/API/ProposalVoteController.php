<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreVoteRequest;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

#[Prefix('/api/v1')]
final class ProposalVoteController
{
    #[Post('/proposals/{school}/vote', middleware: 'auth:sanctum')]
    public function store(StoreVoteRequest $request)
    {

    }
}
