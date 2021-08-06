<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\User;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class TeacherResource extends Resource
{
    public static $icon = 'heroicon-o-academic-cap';
    public static $model = User::class;
    public static $label = 'Teacher';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Grid::make([
                    Components\TextInput::make('name')
                        ->placeholder('First Name Last Name')
                        ->disableAutocomplete()
                        ->required(),
                    Components\TextInput::make('slug')
                        ->label('Username')
                        ->placeholder('someone')
                        ->disableAutocomplete()
                        ->required(),
                ]),
                Components\Grid::make([
                    Components\BelongsToSelect::make('school_id')
                        ->relationship('school', 'name'),
                    Components\TextInput::make('verification_code')
                        ->label('Verification Code')
                        ->placeholder('Save user to view verification code')
                        ->only(Pages\CreateTeacher::class)
                        ->disabled(),
                    Components\TextInput::make('verification_code')
                        ->label('Verification Code')
                        ->only(Pages\EditTeacher::class)
                        ->disabled(),
                ]),
                Components\Checkbox::make('is_verified')
                    ->label('Verified?')
                    ->inline()
                    ->only(Pages\EditTeacher::class)
                    ->disabled(),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListTeachers::routeTo('/', 'index'),
            Pages\CreateTeacher::routeTo('/create', 'create'),
            Pages\EditTeacher::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
