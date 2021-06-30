<?php

namespace Tests\Feature;

use App\Models\Proposal;
use Tests\SancrumTestCase;

final class ProposalsTest extends SancrumTestCase
{
    public function test_it_can_save_proposal(): void
    {
        $proposalData = Proposal::factory()->make()->toArray();

        $this->post("/schools/{$this->school->getRouteKey()}/proposals", $proposalData)
            ->dump()
            ->assertCreated()
            ->assertJsonStructure([
                'data' => ['title', 'body', 'created_at']
            ]);
    }

    public function test_it_can_return_list_of_proposals(): void
    {
        $this->get("/schools/{$this->school->getRouteKey()}/proposals")
            ->dump()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['title', 'body', 'created_at', 'updated_at', 'user_id', 'school_id'],
                ],
            ]);
    }
}
