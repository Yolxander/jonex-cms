<?php

namespace App\Filament\Resources\TranslationResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;

class LinkedTranslationRelationManager extends RelationManager
{
    protected static string $relationship = 'linkedTranslations';
    protected static ?string $title = 'Other Language Version';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('language')
                    ->label('Language'),

                TextColumn::make('value')
                    ->label('Value')
                    ->wrap()
                    ->limit(100),
            ])
            ->actions([
                EditAction::make()
            ]);
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('language')
                ->label('Language')
                ->options([
                    'en' => 'English',
                    'es' => 'Spanish',
                ])
                ->required()
                ->disabled(), // Disable to prevent switching language context

            Forms\Components\Textarea::make('value')
                ->label('Translation Value')
                ->rows(4)
                ->required(),
        ]);
    }
}
