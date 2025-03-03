<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Models\Block;
use App\Models\Content;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Website Management';

    protected static ?string $navigationParentItem = 'Sites';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Select Block
                Select::make('block_id')
                    ->label('Block')
                    ->options(Block::all()->mapWithKeys(fn ($block) => [
                        $block->id => "Block {$block->id} - {$block->type}"
                    ]))
                    ->required()
                    ->searchable(),

                // Content Type Selection
                Select::make('type')
                    ->label('Content Type')
                    ->options([
                        'text' => 'Text',
                        'image' => 'Image',
                        'url' => 'URL',
                    ])
                    ->required()
                    ->reactive(), // Makes the form update dynamically

                // Textarea for "text" type
                Textarea::make('value')
                    ->label('Text Content')
                    ->rows(4)
                    ->hidden(fn ($get) => $get('type') !== 'text'),

                // File Upload for "image" type
                FileUpload::make('value')
                    ->label('Upload Image')
                    ->image()
                    ->disk('public') // Store in "storage/app/public"
                    ->directory('content-images') // Saves to "storage/app/public/content-images"
                    ->preserveFilenames() // Keeps original filename
                    ->nullable()
                    ->hidden(fn ($get) => $get('type') !== 'image')
                    ->dehydrated(fn ($get) => $get('type') === 'image'),

                // Text Input for "URL" type
                TextInput::make('value')
                    ->label('URL')
                    ->placeholder('https://example.com')
                    ->url()
                    ->hidden(fn ($get) => $get('type') !== 'url'),

                // Rich Text Editor for "html" type (Optional)
                RichEditor::make('value')
                    ->label('HTML Content')
                    ->toolbarButtons([
                        'bold', 'italic', 'underline', 'link', 'codeBlock'
                    ])
                    ->hidden(fn ($get) => $get('type') !== 'html'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('block.type')
                    ->label('Block Type')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Content Type')
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Content')
                    ->limit(50),

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
            'index' => Pages\ListContents::route('/'),
            'create' => Pages\CreateContent::route('/create'),
            'edit' => Pages\EditContent::route('/{record}/edit'),
        ];
    }
}
