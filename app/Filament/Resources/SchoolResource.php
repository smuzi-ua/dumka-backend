<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class SchoolResource extends Resource
{
    public static $icon = 'heroicon-o-library';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('name')
                    ->disableAutocomplete()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\Text::make('name')
                    ->primary()
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function relations(): array
    {
        return [
            //
        ];
    }

    public static function routes(): array
    {
        return [
            Pages\ListSchools::routeTo('/', 'index'),
            Pages\CreateSchool::routeTo('/create', 'create'),
            Pages\EditSchool::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
