<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Session;

class TranslationRelationManager extends RelationManager
{
    protected static string $relationship = 'translations';
    protected static ?string $recordTitleAttribute = 'key';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('language')
                    ->label('Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                    ])
                    ->disabled() // Prevent editing key
                    ->required(),

                TextInput::make('key')
                    ->label('Translation Key')
                    ->disabled() // Prevent editing key
                    ->required(),

                Textarea::make('value')
                    ->label('Translation Value')
                    ->required()
                    ->rows(7) // Increased size
                    ->columnSpanFull(), // Makes it take full width for better UX
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('language')
                    ->label('Language')
                    ->sortable(),

                Tables\Columns\TextColumn::make('key')
                    ->label('Key')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => str_contains($state, '.') ? substr(strrchr($state, '.'), 1) : $state),

                Tables\Columns\TextColumn::make('value')
                    ->label('Translation')
                    ->sortable()
                    ->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->label('Filter by Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                    ])
                    ->default(Session::get('translation_language', 'en')),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('key');
    }
}
