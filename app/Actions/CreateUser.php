<?php

namespace App\Actions;

use App\Models\School;
use App\Models\User;
use App\Services\VerificationCodeGenerator;

final class CreateUser
{
    private VerificationCodeGenerator $codeGenerator;

    public function __construct(VerificationCodeGenerator $codeGenerator)
    {
        $this->codeGenerator = $codeGenerator;
    }

    public function handle(School $school, array $data): User
    {
        /** @var User $student */
        $student = $school->users()->make($data);
        $student->verification_code = $this->codeGenerator->generate();
        $student->save();

        return $student;
    }
}
