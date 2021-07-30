<?php

namespace Tests\Feature;

use App\Enums\VoteType;
use App\Models\{Proposal, School, User};
use Tests\SancrumTestCase;

final class ProposalVoteTest extends SancrumTestCase
{
    /** @dataProvider voteTypesProvider */
    public function test_it_can_upvote_successfully(string $type): void
    {
        $proposal = Proposal::factory()
            ->for($this->school)
            ->for($this->user, 'user')
            ->create();

        $this->postJson(
            "/api/v1/proposals/{$proposal->getRouteKey()}/vote",
            [
                'type' => $type,
            ]
        )->dump()->assertSuccessful();
    }

    /** @dataProvider voteTypesProvider */
    public function test_it_can_deny_access(string $type): void
    {
        $differentSchool = School::factory();

        $proposal = Proposal::factory()
            ->for($differentSchool)
            ->for(User::factory()->for($differentSchool))
            ->create();

        $this->postJson(
            "/api/v1/proposals/{$proposal->getRouteKey()}/vote",
            [
                'type' => $type,
            ]
        )->dump()->assertForbidden();
    }

    public function voteTypesProvider(): \Generator
    {
        yield [VoteType::DOWNVOTE];
        yield [VoteType::UPVOTE];
    }
}
