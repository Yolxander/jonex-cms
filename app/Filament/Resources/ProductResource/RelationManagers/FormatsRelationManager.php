<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class FormatsRelationManager extends RelationManager
{
    protected static string $relationship = 'formats';
    protected static ?string $recordTitleAttribute = 'format';

    public function form(Forms\Form $form): Forms\Form
    {
        $product = $this->getOwnerRecord();

        return $form->schema([
            Select::make('format')
                ->label('Format')
                ->options([
                    'Kilo' => 'Kilo',
                    'Liter' => 'Liter',
                    'Box' => 'Box',
                    'Pack' => 'Pack',
                ])
                ->required()
                ->hidden(fn () => $product->hide_formats),

            TextInput::make('price_per_format')
                ->label('Price per Format')
                ->numeric()
                ->required()
                ->hidden(fn () => $product->hide_price),

            TextInput::make('packaging')
                ->label('Packaging')
                ->default('Unknown')
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        $product = $this->getOwnerRecord();

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('format')
                    ->label('Format')
                    ->sortable()
                    ->searchable()
                    ->visible(! $product->hide_formats),

                Tables\Columns\TextColumn::make('price_per_format')
                    ->label('Price per Format')
                    ->sortable()
                    ->money('USD')
                    ->visible(! $product->hide_price),

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
            ->bulkActions([
                BulkAction::make('toggle_hide_price')
                    ->label($product->hide_price ? 'Show Price Column' : 'Hide Price Column')
                    ->action(function () use ($product) {
                        $product->update([
                            'hide_price' => ! $product->hide_price,
                        ]);
                    })
                    ->deselectRecordsAfterCompletion(),

                BulkAction::make('toggle_hide_formats')
                    ->label($product->hide_formats ? 'Show Format Column' : 'Hide Format Column')
                    ->action(function () use ($product) {
                        $product->update([
                            'hide_formats' => ! $product->hide_formats,
                        ]);
                    })
                    ->deselectRecordsAfterCompletion(),
            ])
            ->defaultSort('format');
    }
}
