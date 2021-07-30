<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateUser;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

/**
 * @group Users
 */
#[Prefix('/api/v1')]
final class UserController
{
    /** Create a new user */
    #[Post('schools/{school}/users')]
    public function store(
        School $school,
        StoreUserRequest $request,
        CreateUser $createStudent,
    ) {
        $student = $createStudent->handle($school, $request->validated());

        return StudentResource::make($student);
    }
}
