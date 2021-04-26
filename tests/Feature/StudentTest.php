<?php

namespace Tests\Feature;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class StudentTest extends TestCase
{
    public function test_it_can_create_student(): void
    {
        $school = School::factory()->create();

        $this->post("/schools/{$school->id}/students", [
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

    public function test_it_can_verify_student_and_retrieve_token(): void
    {
        $student = User::first();

        $this->post('/token', [
            'slug'              => $student->slug,
            'verification_code' => $student->verification_code,
        ])->assertJsonStructure([
            'token',
        ]);
    }
}
