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
use Illuminate\Validation\Rule;

class MemberResource extends Resource
{
    public static $icon = 'heroicon-o-academic-cap';
    public static $model = User::class;
    public static $label = 'Members';

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
                        // TODO: add "unique by two fields" validation rule
                        // https://github.com/laravel-filament/filament/discussions/541
                        ->addRules(['unique:users,slug'])
                        ->disableAutocomplete()
                        ->required(),
                ]),
                Components\Grid::make([
                    Components\BelongsToSelect::make('school_id')
                        ->relationship('school', 'name'),
                    Components\TextInput::make('verification_code')
                        ->label('Verification Code')
                        ->only(Pages\CreateMember::class)
                        ->placeholder('XXXXXX')
                        ->helpMessage('Save item to view confirmation code.')
                        ->disabled(),
                    Components\TextInput::make('verification_code')
                        ->label('Verification Code')
                        ->only(Pages\EditMember::class)
                        ->disabled(),
                    Components\Checkbox::make('is_teacher'),
                ]),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name'),
                Columns\Boolean::make('is_verified'),
                Columns\Boolean::make('is_teacher'),
                Columns\Text::make('school.name')
                    ->url(function (User $record) {
                        return route('filament.resources.schools.edit', $record->school->getRouteKey());
                    }, true),
                Columns\Text::make('created_at')->date(),
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
            Pages\ListMembers::routeTo('/', 'index'),
            Pages\CreateMember::routeTo('/create', 'create'),
            Pages\EditMember::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
