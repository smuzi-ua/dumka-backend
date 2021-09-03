<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\MemberResource;
use App\Services\VerificationCodeGenerator;
use Filament\Resources\Forms\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateMember extends CreateRecord
{
    public static $resource = MemberResource::class;

    protected function beforeCreate(): void
    {
        $this->record['verification_code'] = app(VerificationCodeGenerator::class)->generate();
    }
}
