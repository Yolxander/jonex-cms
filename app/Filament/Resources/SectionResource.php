<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers\TranslationRelationManager;
use App\Models\Page;
use App\Models\Section;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

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
                Select::make('page_id')
                    ->label('Page')
                    ->options(Page::pluck('title', 'id')->toArray())
                    ->required()
                    ->searchable()
                    ->columnSpanFull()
                    // Disable if user is not admin
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                TextInput::make('name')
                    ->label('Section Name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull()
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ])
            ->columns(1);
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

                Tables\Columns\TextColumn::make('translations_count')
                    ->label('Translations')
                    ->counts('translations')
                    ->sortable(),

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
                EditAction::make()
                    // Disable Edit if user is not admin
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
                DeleteAction::make()
                    // Disable Delete if user is not admin
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    // Disable bulk Delete if user is not admin
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            TranslationRelationManager::class,
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
