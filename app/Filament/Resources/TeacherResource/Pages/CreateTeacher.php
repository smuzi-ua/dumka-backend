<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use App\Services\VerificationCodeGenerator;
use Filament\Resources\Pages\CreateRecord;

class CreateTeacher extends CreateRecord
{
    public static $resource = TeacherResource::class;

    protected function beforeCreate(): void
    {
        $this->record['is_teacher']        = true;
        $this->record['verification_code'] = app(VerificationCodeGenerator::class)->generate();
    }
}
