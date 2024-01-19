<?php

namespace App\Filament\Resources\BriefLevelResource\Pages;

use App\Filament\Resources\BriefLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBriefLevel extends EditRecord
{
    protected static string $resource = BriefLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
