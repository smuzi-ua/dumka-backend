<?php

namespace Tests;

use App\Models\{Proposal, School, User};
use Laravel\Sanctum\Sanctum;

abstract class SancrumTestCase extends TestCase
{
    protected School $school;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $school = School::factory()->create();

        $user = User::factory()->for($school, 'school')->create();

        Proposal::factory()->for($school)->for(User::factory()->for($school), 'user')->count(10)->create();

        Sanctum::actingAs($user);

        $this->school = $school;
        $this->user = $user;
    }
}
