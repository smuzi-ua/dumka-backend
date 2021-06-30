<?php

namespace Tests\Feature;

use App\Models\{Proposal, School, User};
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

final class ProposalsTest extends TestCase
{
    private School $school;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $school = School::factory()->create();

        $user = User::factory()->make();
        $user->school()->associate($school);
        $user->save();

        $this->school = $school;
        $this->user = $user;
    }

    public function test_it_can_save_proposal(): void
    {
        Sanctum::actingAs($this->user);

        $proposalData = Proposal::factory()->make()->toArray();

        $this->post("/schools/{$this->school->getRouteKey()}/proposals", $proposalData)
            ->dump()
            ->assertCreated()
            ->assertJsonStructure([
                'data' => ['title', 'body', 'created_at']
            ]);
    }
}
