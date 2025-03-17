<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TranslationResource\Pages;
use App\Models\Translation;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Session;

class TranslationResource extends Resource
{
    protected static ?string $model = Translation::class;
    protected static ?string $navigationGroup = 'Content Management';
    protected static ?int $navigationSort = 1; // Adjust position in menu

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('section_id')
                    ->label('Section')
                    ->relationship('section', 'name')
                    ->required(),

                Select::make('language')
                    ->label('Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                    ])
                    ->required(),

                TextInput::make('key')
                    ->label('Translation Key')
                    ->required()
                    ->disabled(), // Prevents user from editing the key

                Textarea::make('value')
                    ->label('Translation Value')
                    ->required()
                    ->rows(3),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('section.name')
                    ->label('Section')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('language')
                    ->label('Language')
                    ->sortable(),

                TextColumn::make('key')
                    ->label('Translation Key')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => str_contains($state, '.') ? substr(strrchr($state, '.'), 1) : $state),

                TextColumn::make('value')
                    ->label('Translation Value')
                    ->limit(50)
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('language')
                    ->label('Filter by Language')
                    ->options([
                        'en' => 'English',
                        'es' => 'Spanish',
                    ])
                    ->default(Session::get('translation_language', 'en')),
            ])
            ->defaultSort('section.name');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTranslations::route('/'),
            'create' => Pages\CreateTranslation::route('/create'),
            'edit' => Pages\EditTranslation::route('/{record}/edit'),
            'show' => Pages\ShowTranslation::route('/{record}'),
        ];
    }
}
