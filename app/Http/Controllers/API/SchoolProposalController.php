<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProposalRequest;
use App\Http\Resources\ProposalResource;
use Illuminate\Http\Request;
use App\Models\{Proposal, School};
use Spatie\RouteAttributes\Attributes\{Get, Post, Prefix};
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Proposals
 * @authenticated
 */
#[Prefix('/api/v1')]
final class SchoolProposalController
{
    /** Get a list of proposals */
    #[Get('/schools/{school}/proposals', middleware: 'auth:sanctum')]
    public function index(School $school, Request $request)
    {
        if (!$request->user()->school()->is($school)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return ProposalResource::collection($school->proposals);
    }

    /** Add a new proposal */
    #[Post('/schools/{school}/proposals', middleware: 'auth:sanctum')]
    public function store(School $school, StoreProposalRequest $request)
    {
        if (!$request->user()->school()->is($school)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $proposal = new Proposal;
        $proposal->fill($request->validated());
        $proposal->user()->associate($request->user());
        $proposal->school()->associate($school);
        $proposal->save();

        return ProposalResource::make($proposal);
    }
}
