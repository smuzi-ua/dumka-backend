<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Resources\Pages\ListRecords;

class ListTeachers extends ListRecords
{
    public static $resource = TeacherResource::class;

    public static function getQuery()
    {
        return parent::getQuery()->hasTeacherRole();
    }

    public static function getTitle()
    {
        return 'Teachers';
    }
}
