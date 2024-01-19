<?php

namespace App\Filament\Resources\BriefBranchResource\Pages;

use App\Filament\Resources\BriefBranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBriefBranches extends ListRecords
{
    protected static string $resource = BriefBranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
