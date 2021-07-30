<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProposalRequest;
use App\Http\Resources\ProposalResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\{Proposal, School};
use Spatie\RouteAttributes\Attributes\{Get, Post, Prefix};

/**
 * @group Proposals
 * @authenticated
 */
#[Prefix('/api/v1')]
final class SchoolProposalController
{
    use AuthorizesRequests;

    /** Get a list of proposals */
    #[Get('/schools/{school}/proposals', middleware: 'auth:sanctum')]
    public function index(School $school)
    {
        $this->authorize('viewAny', [Proposal::class, $school]);

        return ProposalResource::collection($school->proposals);
    }

    /** Add a new proposal */
    #[Post('/schools/{school}/proposals', middleware: 'auth:sanctum')]
    public function store(School $school, StoreProposalRequest $request)
    {
        $this->authorize('create', [Proposal::class, $school]);

        $proposal = Proposal::make($request->validated())
            ->user()
            ->associate($request->user())
            ->school()
            ->associate($school);

        $proposal->save();

        return ProposalResource::make($proposal);
    }
}
