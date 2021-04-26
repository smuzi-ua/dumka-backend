<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateStudent;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;

final class StudentController
{
    public function store(
        School $school,
        StoreStudentRequest $request,
        CreateStudent $createStudent,
    ) {
        $student = $createStudent->handle($school, $request->validated());

        return StudentResource::make($student);
    }
}
