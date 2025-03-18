<?php

namespace App\Filament\Resources;

use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Filament\Resources\RoleResource\Pages;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Role Name')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('users')
                ->label('Assign Users')
                ->multiple()
                ->relationship(name: 'users', titleAttribute: 'name')
                ->preload()
                ->searchable()
                ->saveRelationshipsUsing(fn (Role $role, $state) =>
                $role->users()->sync($state)
                ),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Role Name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('users.name')
                ->label('Assigned Users')
                ->badge()
                ->limit(3)
                ->sortable()
                ->searchable(),
        ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
