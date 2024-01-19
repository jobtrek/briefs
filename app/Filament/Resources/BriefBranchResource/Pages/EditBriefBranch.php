<?php

namespace App\Filament\Resources\BriefBranchResource\Pages;

use App\Filament\Resources\BriefBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBriefBranch extends EditRecord
{
    protected static string $resource = BriefBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
