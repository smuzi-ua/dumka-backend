<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateUser;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\{School, User};
use Spatie\RouteAttributes\Attributes\{Get, Post, Prefix};

/**
 * @group Users
 */
#[Prefix('/api/v1')]
final class SchoolUserController
{
    /** Fetch user by school and slug */
    #[Get('/schools/{school}/users/{slug}')]
    public function show(School $school, User $user)
    {
        return UserResource::make($user);
    }

    /** Create a new user */
    #[Post('schools/{school}/users')]
    public function store(
        School $school,
        StoreUserRequest $request,
        CreateUser $createStudent,
    ) {
        $student = $createStudent->handle($school, $request->validated());

        return UserResource::make($student);
    }
}
