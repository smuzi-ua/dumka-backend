<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;

final class StudentController
{
    public function store(School $school, StoreStudentRequest $request)
    {
        $student = $school->students()->create($request->validated());

        return StudentResource::make($student);
    }
}
