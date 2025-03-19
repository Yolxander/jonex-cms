<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TutorialResource\Pages;
use App\Models\Tutorial;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Panel;

class TutorialResource extends Resource
{
    protected static ?string $model = Tutorial::class;

    protected static ?string $navigationIcon = 'heroicon-o-play';
    protected static ?string $navigationGroup = 'CMS Help';
    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Tutorial Title')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->nullable(),

                TextInput::make('video_url')
                    ->label('Vimeo Video URL')
                    ->url()
                    ->placeholder('https://vimeo.com/123456789')
                    ->required(),

                Toggle::make('published')
                    ->label('Published')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Panel::make([
                    Stack::make([
                        // 🎬 VIDEO PREVIEW
                        TextColumn::make('video_url')
                            ->label('Preview')
                            ->formatStateUsing(fn ($state) => view('components.video-thumbnail', ['videoUrl' => $state]))
                            ->html(),

                        // 📌 TITLE & DETAILS
                        Stack::make([
                            TextColumn::make('title')
                                ->label('Title')
                                ->size('lg')
                                ->weight('bold'),

                            IconColumn::make('published')
                                ->label('Published')
                                ->boolean()
                                ->trueIcon('heroicon-o-check-circle')
                                ->falseIcon('heroicon-o-x-circle'),

                            TextColumn::make('created_at')
                                ->label('Created At')
                                ->dateTime(),

                            TextColumn::make('video_url')
                                ->label('Watch Video')
                                ->formatStateUsing(fn ($state) => "<a href='{$state}' target='_blank' class='text-primary underline'>Open</a>")
                                ->html(),
                        ]),
                    ]),
                ])
                    ->extraAttributes(['class' => 'p-4 shadow-md bg-white rounded-lg']),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('published')
                    ->label('Filter by Status')
                    ->options([
                        true => 'Published',
                        false => 'Draft',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTutorials::route('/'),
            'create' => Pages\CreateTutorial::route('/create'),
            'edit' => Pages\EditTutorial::route('/{record}/edit'),
        ];
    }
}
