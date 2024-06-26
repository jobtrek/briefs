<?php

namespace App\Filament\Resources\BriefRealisationResource\Pages;

use App\Filament\Resources\BriefRealisationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBriefRealisation extends EditRecord
{
    protected static string $resource = BriefRealisationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (now()->gt($data['date_fin']) && $data['status'] !== 'delivered') {
            $data['status'] = 'undelivered';
        }
        return $data;
    }
}
