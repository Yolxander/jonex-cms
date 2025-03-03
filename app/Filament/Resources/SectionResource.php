<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers\BlockRelationManager;
use App\Models\Block;
use App\Models\Content;
use App\Models\Page;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class SectionResource extends Resource
{
    protected static ?string $model = Section::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Website Management';

    protected static ?string $navigationParentItem = 'Sites';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Create Section')
                        ->schema([
                            Select::make('page_id')
                                ->label('Page')
                                ->options(Page::pluck('title', 'id')->toArray()) // Fetches page names dynamically
                                ->required()
                                ->searchable()
                                ->columnSpanFull(),

                            TextInput::make('name')
                                ->label('Section Name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                        ]),

                    Step::make('Add Block')
                        ->schema([
                            Select::make('block_type')
                                ->label('Block Type')
                                ->options([
                                    'header' => 'Header',
                                    'card' => 'Card',
                                    'button' => 'Button',
                                ])
                                ->required()
                                ->searchable()
                                ->columnSpanFull(),

                            TextInput::make('block_name')
                                ->label('Block Name')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                        ]),

                    Step::make('Add Content')
                        ->schema([
                            Select::make('content_type')
                                ->label('Content Type')
                                ->options([
                                    'text' => 'Text',
                                    'image' => 'Image',
                                    'url' => 'URL',
                                ])
                                ->required()
                                ->reactive()
                                ->columnSpanFull(),

                            Textarea::make('content_value')
                                ->label('Text Content')
                                ->rows(4)
                                ->hidden(fn ($get) => $get('content_type') !== 'text')
                                ->columnSpanFull(),

                            FileUpload::make('content_value')
                                ->label('Upload Image')
                                ->image()
                                ->disk('public')
                                ->directory('content-images')
                                ->preserveFilenames()
                                ->nullable()
                                ->hidden(fn ($get) => $get('content_type') !== 'image')
                                ->columnSpanFull(),

                            TextInput::make('content_value')
                                ->label('URL')
                                ->placeholder('https://example.com')
                                ->url()
                                ->hidden(fn ($get) => $get('content_type') !== 'url')
                                ->columnSpanFull(),
                        ]),
                ])
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function mutateFormDataBeforeCreate(array $data): array
    {
        // Step 1: Create Section
        $section = Section::create([
            'page_id' => $data['page_id'],
            'name' => $data['name'],
        ]);

        // Step 2: Create Block and link to Section
        $block = Block::create([
            'section_id' => $section->id,
            'type' => $data['block_type'],
        ]);

        // Step 3: Create Content and link to Block
        Content::create([
            'block_id' => $block->id,
            'type' => $data['content_type'],
            'value' => $data['content_value'],
        ]);

        return $data; // Return the modified data so Filament recognizes the new records
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('page.title')
                    ->label('Page')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Section Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('page_id')
                    ->label('Filter by Page')
                    ->relationship('page', 'title'),
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
        return [
            BlockRelationManager::class, // Connect Blocks to Sections
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),
            'create' => Pages\CreateSection::route('/create'),
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
