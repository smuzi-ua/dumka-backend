<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\StudentTokenRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Spatie\RouteAttributes\Attributes\{Post, Prefix};

#[Prefix('/api/v1')]
final class StudentTokenController
{
    #[Post('/token')]
    public function __invoke(StudentTokenRequest $request)
    {
        $student = User::whereSlug($request->slug)->first();

        if (!$student || $student->verification_code !== $request->verification_code) {
            throw ValidationException::withMessages([
                'verification_code' => 'Verification code is invalid.'
            ]);
        }

        $student->verify();

        return [
            'token' => $student->createToken($request->userAgent())->plainTextToken
        ];
    }
}