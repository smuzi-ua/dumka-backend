<?php

namespace Tests\Feature;

use App\Models\Proposal;
use App\Models\School;
use Tests\SancrumTestCase;

final class ProposalTest extends SancrumTestCase
{
    public function test_it_can_save_proposal(): void
    {
        $proposalData = Proposal::factory()->make()->toArray();

        $this->postJson("/api/v1/schools/{$this->school->getRouteKey()}/proposals", $proposalData)
            ->dump()
            ->assertCreated()
            ->assertJsonStructure([
                'data' => ['title', 'body', 'created_at']
            ]);
    }

    public function test_it_can_return_list_of_proposals(): void
    {
        $this->getJson("/api/v1/schools/{$this->school->getRouteKey()}/proposals")
            ->dump()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['title', 'body', 'created_at', 'updated_at', 'user_id', 'school_id'],
                ],
            ]);
    }

    public function test_it_authorizes_list_of_proposals(): void
    {
        $differentSchool = School::factory()->create();

        $this->getJson("/api/v1/schools/{$differentSchool->getRouteKey()}/proposals")
            ->assertForbidden();
    }


    public function test_it_authorizes_proposal_creation(): void
    {
        $differentSchool = School::factory()->create();
        $proposalData    = Proposal::factory()->make()->toArray();

        $this->postJson(
            "/api/v1/schools/{$differentSchool->getRouteKey()}/proposals",
            $proposalData
        )->assertForbidden();
    }
}
