<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers\SectionsRelationManager;
use App\Models\Page;
use App\Models\Site;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Illuminate\Database\Eloquent\Builder;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Website Management';
    protected static ?string $navigationParentItem = 'Sites';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('site_id')
                    ->label('Site')
                    ->options(Site::pluck('name', 'id')->toArray())
                    ->required()
                    ->searchable()
                    // Disable if user does not have 'admin' role
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                Forms\Components\TextInput::make('title')
                    ->label('Page Title')
                    ->required()
                    ->maxLength(255)
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site.name')
                    ->label('Site')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Page Title')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make()
                    // Disable Edit if user doesn't have 'admin' role
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                DeleteAction::make()
                    // Disable Delete if user doesn't have 'admin' role
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    // Disable bulk Delete if user doesn't have 'admin' role
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SectionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
