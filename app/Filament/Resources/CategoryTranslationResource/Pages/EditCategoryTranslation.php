<?php

namespace App\Filament\Resources\CategoryTranslationResource\Pages;

use App\Filament\Resources\CategoryTranslationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryTranslation extends EditRecord
{
    protected static string $resource = CategoryTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
