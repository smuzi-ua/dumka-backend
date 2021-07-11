<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreVoteRequest;
use App\Models\Proposal;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

/** @group Proposals */
#[Prefix('/api/v1')]
final class ProposalVoteController
{
    /** Vote for a proposal */
    #[Post('/proposals/{proposal}/vote', middleware: 'auth:sanctum')]
    public function store(Proposal $proposal, StoreVoteRequest $request)
    {
        $vote = $proposal->votes()->where('user_id', $request->user()->id)->firstOrNew();

        $vote->update($request->validated());

        return response()->noContent();
    }
}
