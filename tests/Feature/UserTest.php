<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class UserTest extends TestCase
{
    public function test_it_can_create_user(): void
    {
        $school = School::factory()->create();

        $this->postJson("/api/v1/schools/{$school->id}/users", [
            'name' => 'John Doe',
            'slug' => 'johndoe'.Str::random()
        ])->assertJsonStructure([
            'data' => ['id', 'name']
        ])->assertJson(fn(AssertableJson $json) => $json
            ->has('data.id')
            ->where('data.name', 'John Doe')
            ->missing('data.verification_code')
            ->missing('data.verified_at')
        );
    }

    public function test_it_can_verify_user_and_retrieve_token(): void
    {
        $user = User::factory()->for(School::factory())->create();

        $this->postJson('/api/v1/users/verification', [
            'slug'              => $user->slug,
            'verification_code' => $user->verification_code,
        ])->dump()->assertSuccessful()->assertJsonStructure([
            'token',
        ]);

        // User can't be verified twice with the same token.
        // We should check that as well for security reasons.
        $this->postJson('/api/v1/users/verification', [
            'slug'              => $user->slug,
            'verification_code' => $user->verification_code,
        ])->dump()->assertJsonValidationErrors([
            'verification_code'
        ]);
    }

    public function test_it_can_decline_user_verification(): void
    {
        $user = User::first();

        $this->postJson('/api/v1/users/verification', [
            'slug'              => $user->slug,
            'verification_code' => Str::random(),
        ])->assertJsonStructure([
            'message',
            'errors' => ['verification_code']
        ]);
    }
}
