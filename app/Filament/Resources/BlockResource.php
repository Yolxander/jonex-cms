<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlockResource\Pages;
use App\Models\Block;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;

class BlockResource extends Resource
{
    protected static ?string $model = Block::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
//    protected static ?int $navigationSort = 3;
//    protected static ?string $navigationGroup = 'Website Management';

    protected static ?string $navigationParentItem = 'Sites';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section connection
                Select::make('section_id')
                    ->label('Section')
                    ->options(Section::pluck('name', 'id')->toArray()) // Fetches  names dynamically
                    ->required()
                    ->searchable(),

                // Block Type Selection (Header, Card, Button)
                Select::make('type')
                    ->label('Block Type')
                    ->options([
                        'header' => 'Header',
                        'card' => 'Card',
                        'button' => 'Button',
                    ])
                    ->required()
                    ->reactive(),

                // Content Repeater with Conditional Content Type Restrictions
                Repeater::make('contents')
                    ->label('Contents')
                    ->relationship('contents') // Ensure block has many contents
                    ->schema([
                        Select::make('type')
                            ->label('Content Type')
                            ->options(fn ($get) => match ($get('../../type')) {
                                'header' => ['text' => 'Text'], // Only text for headers
                                'card' => ['text' => 'Text', 'image' => 'Image'], // Text & Image for cards
                                'button' => ['url' => 'URL'], // URL for buttons
                                default => [],
                            })
                            ->required()
                            ->reactive(),

                        // Text Input (Only for Text Type)
                        TextInput::make('value')
                            ->label('Text Content')
                            ->hidden(fn ($get) => $get('type') !== 'text'),

                        // Image Upload (Only for Image Type)
                        Forms\Components\FileUpload::make('value')
                            ->label('Upload Image')
                            ->disk('public')
                            ->directory('content-images')
                            ->hidden(fn ($get) => $get('type') !== 'image'),

                        // URL Input (Only for URL Type)
                        TextInput::make('value')
                            ->label('Button URL')
                            ->url()
                            ->hidden(fn ($get) => $get('type') !== 'url'),
                    ])
                    ->hidden(fn ($get) => empty($get('type'))) // Hide if no type is selected
                    ->columns(2), // Make it visually organized
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.name')
                    ->label('Section')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Block Type')
                    ->sortable(),

                Tables\Columns\TextColumn::make('contents_count')
                    ->label('Contents Count')
                    ->counts('contents'),// Show the number of contents

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
        EditAction::make(),
        DeleteAction::make(),
    ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlocks::route('/'),
            'create' => Pages\CreateBlock::route('/create'),
            'edit' => Pages\EditBlock::route('/{record}/edit'),
        ];
    }
}
