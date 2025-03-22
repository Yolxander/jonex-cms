<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class CategoryTranslationsRelationManager extends RelationManager
{
    protected static string $relationship = 'translations';
    protected static ?string $recordTitleAttribute = 'language';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('language')
                ->label('Language')
                ->options([
                    'en' => 'English',
                    'es' => 'Spanish',
                ])
                ->required(),
            TextInput::make('name')
                ->label('Translated Name')
                ->required(),

            Textarea::make('description')
                ->label('Translated Description')
                ->rows(4)
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('language')
                    ->label('Language')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->label('Filter by Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('language');
    }
}
