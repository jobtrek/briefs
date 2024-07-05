<?php

namespace App\Filament\Resources\ProfessionalEvaluationResource\Pages;

use App\Filament\Resources\ProfessionalEvaluationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfessionalEvaluation extends EditRecord
{
    protected static string $resource = ProfessionalEvaluationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
