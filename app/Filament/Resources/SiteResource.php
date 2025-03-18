<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteResource\Pages;
use App\Models\Site;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles; // Ensure your User model uses HasRoles

class SiteResource extends Resource
{
    protected static ?string $model = Site::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Website Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Site Name')
                    ->required()
                    ->maxLength(255)
                    // Disable if user doesn't have 'admin' role
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                Forms\Components\TextInput::make('url')
                    ->label('Website URL')
                    ->url()
                    ->required()
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->nullable()
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Site Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
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
                Tables\Actions\DeleteBulkAction::make()
                    // Disable bulk Delete if user doesn't have 'admin' role
                    ->disabled(fn () => ! auth()->user()->hasRole('admin')),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSites::route('/'),
            'create' => Pages\CreateSite::route('/create'),
            'edit' => Pages\EditSite::route('/{record}/edit'),
        ];
    }
}
