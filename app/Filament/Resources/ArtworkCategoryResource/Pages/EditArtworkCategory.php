<?php

namespace App\Filament\Resources\ArtworkCategoryResource\Pages;

use App\Filament\Resources\ArtworkCategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtworkCategory extends EditRecord
{
    protected static string $resource = ArtworkCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
