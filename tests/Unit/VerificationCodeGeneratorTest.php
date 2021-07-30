<?php

namespace Tests\Unit;

use App\Services\VerificationCodeGenerator;
use PHPUnit\Framework\TestCase;

final class VerificationCodeGeneratorTest extends TestCase
{
    private VerificationCodeGenerator $codeGenerator;

    protected function setUp(): void
    {
        $this->codeGenerator = app(VerificationCodeGenerator::class);
        parent::setUp();
    }

    public function test_it_can_return_valid_output(): void
    {
        $output = $this->codeGenerator->generate();

        $this->assertEquals(5, strlen($output));
    }
}
