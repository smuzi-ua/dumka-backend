<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreProposalRequest;
use App\Http\Resources\ProposalResource;
use Illuminate\Http\Request;
use App\Models\{Proposal, School};
use Illuminate\Routing\Middleware\SubstituteBindings;
use Spatie\RouteAttributes\Attributes\{Get, Post, Prefix};
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Proposals
 * @authenticated
 */
#[Prefix('/api/v1')]
final class SchoolProposalController
{
    #[Get('/schools/{school}/proposals', middleware: ['auth:sanctum', SubstituteBindings::class])]
    public function index(School $school, Request $request)
    {
        if (!$request->user()->school()->is($school)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return ProposalResource::collection($school->proposals);
    }

    #[Post('/schools/{school}/proposals', middleware: ['auth:sanctum', SubstituteBindings::class])]
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
