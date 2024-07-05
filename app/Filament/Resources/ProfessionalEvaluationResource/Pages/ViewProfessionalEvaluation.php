<?php

namespace App\Filament\Resources\ProfessionalEvaluationResource\Pages;

use App\Filament\Resources\ProfessionalEvaluationResource;
use Filament\Resources\Pages\ViewRecord;

class ViewProfessionalEvaluation extends ViewRecord
{
    protected static string $resource = ProfessionalEvaluationResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
