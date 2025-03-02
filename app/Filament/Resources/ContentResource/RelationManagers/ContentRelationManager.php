<?php

namespace App\Filament\Resources\ContentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class ContentRelationManager extends RelationManager
{
    protected static string $relationship = 'content';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->label('Content Type')
                    ->options([
                        'text' => 'Text',
                        'image' => 'Image',
                        'video' => 'Video',
                        'html' => 'HTML',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('value')
                    ->label('Content Value')
                    ->nullable()
                    ->rows(4),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Content Type')
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Content')
                    ->limit(50),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
