<?php

namespace App\Http\Controllers\API;

use App\Actions\CreateUser;
use App\Http\Resources\UserResource;
use App\Models\{School, User};
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};
use App\Http\Requests\{AuthenticationRequest, UserVerificationRequest};

/** @group Users */
#[Prefix('/api/v1')]
final class AuthController
{
    /**
     * Authentication
     *
     * Makes a new verification code. Will register the account if it doesn't already exist
     */
    #[Post('/schools/{school}/users/auth')]
    public function auth(
        School $school,
        AuthenticationRequest $request,
        CreateUser $createUser,
    ) {
        $user = $school->users()->whereSlug($request->slug)->first();

        if (!$user) {
            $request->validate(['name' => 'required']);
            $user = $createUser->handle($school, $request->validated());
        }

        if (!$user->verification_code) {
            $user->setRandomVerificationCode()->save();
        }

        return UserResource::make($user);
    }

    /**
     * Verification
     *
     * Get user token by passing one-time verification code.
     */
    #[Post('/schools/{school}/users/verify')]
    public function verify(UserVerificationRequest $request)
    {
        /** @var User $user */
        $user = User::whereSlug($request->slug)->first();

        if (!$user || $user->verification_code !== $request->verification_code) {
            throw ValidationException::withMessages([
                'verification_code' => 'Verification code is invalid.'
            ]);
        }

        $user->verify();

        return [
            'token' => $user->createToken($request->userAgent())->plainTextToken
        ];
    }
}
