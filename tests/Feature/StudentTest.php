<?php

namespace Tests\Feature;

use App\Models\School;
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
}
