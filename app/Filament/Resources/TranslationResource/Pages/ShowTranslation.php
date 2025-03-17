<?php

namespace App\Filament\Resources\TranslationResource\Pages;

use App\Filament\Resources\TranslationResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use App\Models\Translation;
use App\Models\Section;

class ShowTranslation extends ViewRecord
{
    protected static string $resource = TranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormSchema(): array
    {
        $sections = Section::with('translations')->get();

        $tabs = [];
        foreach ($sections as $section) {
            $translations = $section->translations->groupBy('language');

            $tabs[$section->name] = [
                'columns' => [
                    TextColumn::make('key')->label('Translation Key')->sortable(),
                    TextColumn::make('language')->label('Language')->sortable(),
                    TextColumn::make('value')->label('Translation Value'),
                ],
                'data' => $translations,
            ];
        }

        return [
            Forms\Components\Tabs::make('Translations')
                ->tabs(array_map(function ($sectionName, $data) {
                    return Forms\Components\Tabs\Tab::make($sectionName)
                        ->schema([
                            Forms\Components\Repeater::make('translations')
                                ->schema([
                                    TextColumn::make('key')->label('Key'),
                                    TextColumn::make('language')->label('Language'),
                                    TextColumn::make('value')->label('Value'),
                                ])
                                ->defaultItems($data['data']->values()->toArray()),
                        ]);
                }, array_keys($tabs), array_values($tabs))),
        ];
    }
}
