<?php

namespace App\Filament\Resources\ProfessionalEvaluationResource\Pages;

use App\Models\ProfessionalEvaluation;
use Filament\Widgets\ChartWidget;

class ProfessionnalEvaluation extends ChartWidget
{
    protected static ?string $heading = 'Évaluation Professionnelle';
    protected static ?string $maxHeight = '350px';


    protected function getData(): array
    {
        $evaluations = ProfessionalEvaluation::all();

        return [
            'datasets' => [
                [
                    'label' => 'Évaluations',
                    'data' => [
                        $evaluations->avg('teamwork'),
                        $evaluations->avg('punctuality'),
                        $evaluations->avg('reactivity'),
                        $evaluations->avg('communication'),
                        $evaluations->avg('problem_solving'),
                        $evaluations->avg('adaptability'),
                        $evaluations->avg('innovation'),
                        $evaluations->avg('professionalism'),
                    ],
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)',
                        'rgba(83, 102, 255, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => [
                'Travail en équipe',
                'Ponctualité',
                'Réactivité',
                'Communication',
                'Résolution de problèmes',
                'Adaptabilité',
                'Innovation',
                'Professionnalisme',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
