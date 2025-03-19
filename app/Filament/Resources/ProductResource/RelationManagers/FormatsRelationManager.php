<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class FormatsRelationManager extends RelationManager
{
    protected static string $relationship = 'formats';
    protected static ?string $recordTitleAttribute = 'format';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('format')
                    ->label('Format')
                    ->options([
                        'Kilo' => 'Kilo',
                        'Liter' => 'Liter',
                        'Box' => 'Box',
                        'Pack' => 'Pack',
                    ])
                    ->required(),

                TextInput::make('price_per_format')  // Match the column name in the database
                ->label('Price per Format')
                    ->numeric()
                    ->required(),

                TextInput::make('packaging')
                    ->label('Packaging')
                    ->default('Unknown')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('format')
                    ->label('Format')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price_per_format') // Match the column name in the database
                ->label('Price per Format')
                    ->sortable()
                    ->money('USD'),

                Tables\Columns\TextColumn::make('packaging')
                    ->label('Packaging')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('format')
                    ->label('Filter by Format')
                    ->options([
                        'Kilo' => 'Kilo',
                        'Liter' => 'Liter',
                        'Box' => 'Box',
                        'Pack' => 'Pack',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('format');
    }
}
