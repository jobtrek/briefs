<?php

namespace App\Filament\Resources\BriefRealisationResource\Pages;

use App\Filament\Resources\BriefRealisationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBriefRealisation extends CreateRecord
{
    protected static string $resource = BriefRealisationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['status'] = 'new';
        return $data;
    }
}
