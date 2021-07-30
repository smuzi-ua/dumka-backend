<?php

namespace Tests\Feature;

use App\Enums\VoteType;
use App\Models\Proposal;
use Tests\SancrumTestCase;

final class ProposalTest extends SancrumTestCase
{
    public function test_it_can_save_proposal(): void
    {
        $proposalData = Proposal::factory()->make()->toArray();

        $this->post("/api/v1/schools/{$this->school->getRouteKey()}/proposals", $proposalData)
            ->dump()
            ->assertCreated()
            ->assertJsonStructure([
                'data' => ['title', 'body', 'created_at']
            ]);
    }

    public function test_it_can_return_list_of_proposals(): void
    {
        $this->get("/api/v1/schools/{$this->school->getRouteKey()}/proposals")
            ->dump()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['title', 'body', 'created_at', 'updated_at', 'user_id', 'school_id'],
                ],
            ]);
    }

    public function test_it_can_upvote_successfully(): void
    {
        $proposal = Proposal::factory()
            ->for($this->school)
            ->for($this->user, 'user')
            ->create();

        $this->post("/api/v1/proposals/{$proposal->getRouteKey()}/vote", [
            'type' => VoteType::UPVOTE,
        ])->dump()->assertSuccessful();
    }
}
