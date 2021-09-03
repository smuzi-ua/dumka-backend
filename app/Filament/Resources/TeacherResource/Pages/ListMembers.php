<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    public static $resource = MemberResource::class;

    public static function getQuery()
    {
        return parent::getQuery()->latest();
    }

    public static function getTitle()
    {
        return 'Members';
    }
}
