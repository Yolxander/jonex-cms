<?php

namespace App\Filament\Resources\SectionResource\RelationManagers;

use App\Models\Block;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Resources\RelationManagers\RelationManager;

class BlockRelationManager extends RelationManager
{
    protected static string $relationship = 'blocks'; // This should match the relation in Section model

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Block Type Selection
                Forms\Components\Select::make('type')
                    ->label('Block Type')
                    ->options([
                        'header' => 'Header',
                        'card' => 'Card',
                        'button' => 'Button',
                    ])
                    ->required(),

                // Dynamic Name Input
                Forms\Components\TextInput::make('name')
                    ->label('Block Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Block Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Block Type')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
