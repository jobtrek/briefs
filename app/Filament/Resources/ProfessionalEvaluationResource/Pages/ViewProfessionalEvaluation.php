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
            \App\Filament\Widgets\ProfessionnalEvaluation::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
