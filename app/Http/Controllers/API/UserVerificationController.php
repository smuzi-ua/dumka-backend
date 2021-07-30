<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StudentTokenRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

/**
 * @group Users
 */
#[Prefix('/api/v1')]
final class UserVerificationController
{
    /** Verify user */
    #[Post('/users/verification')]
    public function __invoke(StudentTokenRequest $request)
    {
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
