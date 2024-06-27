<?php

namespace App\Filament\Resources\ProfessionalEvaluationResource\Pages;

use App\Filament\Resources\ProfessionalEvaluationResource;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\EvaluationStatistics;

class ListProfessionalEvaluations extends ListRecords
{
    protected static string $resource = ProfessionalEvaluationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            EvaluationStatistics::class,
        ];
    }
}
