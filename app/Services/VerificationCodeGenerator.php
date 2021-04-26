<?php

namespace App\Services;

use Illuminate\Support\Str;

final class VerificationCodeGenerator
{
    public function generate(): string
    {
        return Str::random(length: 5);
    }
}
