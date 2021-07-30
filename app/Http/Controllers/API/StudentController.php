<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateStudent;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

/**
 * @group Students
 */
#[Prefix('/api/v1')]
final class StudentController
{
    /** Create a new student */
    #[Post('schools/{school}/students')]
    public function store(
        School $school,
        StoreStudentRequest $request,
        CreateStudent $createStudent,
    ) {
        $student = $createStudent->handle($school, $request->validated());

        return StudentResource::make($student);
    }
}
