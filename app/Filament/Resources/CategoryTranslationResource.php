<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryTranslationResource\Pages;
use App\Models\CategoryTranslation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class CategoryTranslationResource extends Resource
{
    protected static ?string $model = CategoryTranslation::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Orders';
    protected static ?string $navigationParentItem = 'Categories';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('category_id')
                ->label('Category')
                ->options(\App\Models\Category::pluck('name', 'id')->toArray())
                ->required()
                ->searchable(),


            Forms\Components\Select::make('language')
                ->options([
                    'en' => 'English',
                    'es' => 'Spanish',
                ])
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Translated Name')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->label('Translated Description')
                ->rows(3)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')->label('Category'),
                Tables\Columns\TextColumn::make('language')->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Name')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Description')->limit(50),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoryTranslations::route('/'),
            'create' => Pages\CreateCategoryTranslation::route('/create'),
            'edit' => Pages\EditCategoryTranslation::route('/{record}/edit'),
        ];
    }
}
