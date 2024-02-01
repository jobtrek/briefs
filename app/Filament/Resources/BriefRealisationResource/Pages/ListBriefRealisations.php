<?php

namespace App\Filament\Resources\BriefRealisationResource\Pages;

use App\Filament\Resources\BriefRealisationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBriefRealisations extends ListRecords
{
    protected static string $resource = BriefRealisationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
