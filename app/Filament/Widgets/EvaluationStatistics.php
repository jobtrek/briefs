<?php

namespace App\Filament\Widgets;

use App\Models\ProfessionalEvaluation;
use Filament\Widgets\Widget;

class EvaluationStatistics extends Widget
{
    protected static string $view = 'filament.widgets.evaluation-statistics';

    public $evaluationData = [];

    public function mount()
    {
        $this->evaluationData = $this->getEvaluationStatistics();
    }

    protected function getEvaluationStatistics()
    {
        $evaluations = ProfessionalEvaluation::all();

        // Préparer les données pour Chart.js
        $statistics = [
            'labels' => [
                'Travail en équipe',
                'Ponctualité',
                'Réactivité',
                'Communication',
                'Résolution de problèmes',
                'Adaptabilité',
                'Innovation',
                'Professionnalisme'
            ],
            'data' => [
                $evaluations->avg('teamwork') ?? 0,
                $evaluations->avg('punctuality') ?? 0,
                $evaluations->avg('reactivity') ?? 0,
                $evaluations->avg('communication') ?? 0,
                $evaluations->avg('problem_solving') ?? 0,
                $evaluations->avg('adaptability') ?? 0,
                $evaluations->avg('innovation') ?? 0,
                $evaluations->avg('professionalism') ?? 0,
            ],
        ];

        return $statistics;
    }
}
