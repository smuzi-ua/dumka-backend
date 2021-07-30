<?php

namespace App\Http\Controllers\API;

use App\Enums\VoteType;
use App\Http\Requests\StoreVoteRequest;
use App\Http\Responses\VotesResponse;
use App\Models\Proposal;
use App\Models\Vote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

/** @group Proposals */
#[Prefix('/api/v1')]
final class ProposalVoteController
{
    use AuthorizesRequests;

    /** Vote for a proposal */
    #[Post('/proposals/{proposal}/vote', middleware: 'auth:sanctum')]
    public function store(Proposal $proposal, StoreVoteRequest $request)
    {
        $this->authorize('create', [Vote::class, $proposal]);

        $request->user()->vote($request->get('type'), $proposal);

        return new VotesResponse(
            upVotes: $proposal->votes()->whereType(VoteType::UPVOTE)->count(),
            downVotes: $proposal->votes()->whereType(VoteType::DOWNVOTE)->count(),
        );
    }
}
