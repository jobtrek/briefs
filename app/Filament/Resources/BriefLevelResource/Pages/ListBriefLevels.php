<?php

namespace App\Filament\Resources\BriefLevelResource\Pages;

use App\Filament\Resources\BriefLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBriefLevels extends ListRecords
{
    protected static string $resource = BriefLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
