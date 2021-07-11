<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreVoteRequest;
use App\Models\{Proposal, User, Vote};
use Spatie\RouteAttributes\Attributes\{Post, Prefix};
use Symfony\Component\HttpFoundation\Response;

/** @group Proposals */
#[Prefix('/api/v1')]
final class ProposalVoteController
{
    /** Vote for a proposal */
    #[Post('/proposals/{proposal}/vote', middleware: 'auth:sanctum')]
    public function store(Proposal $proposal, StoreVoteRequest $request)
    {
        /** @var Vote $vote */
        $vote = $proposal->votes()->make($request->validated());
        $vote->user()->associate(User::class);
        $vote->save();

        return response()->noContent(Response::HTTP_CREATED);
    }
}
