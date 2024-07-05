<?php

namespace App\Filament\Resources\ProfessionalEvaluationResource\Pages;

use App\Filament\Resources\ProfessionalEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfessionalEvaluations extends ListRecords
{
    protected static string $resource = ProfessionalEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProfessionalEvaluationResource\Pages\ProfessionnalEvaluation::class,

        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
        ];
    }

}
