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

        // Calculer les moyennes pour chaque critère
        $averages = [
            'teamwork' => $evaluations->avg('teamwork'),
            'punctuality' => $evaluations->avg('punctuality'),
            'reactivity' => $evaluations->avg('reactivity'),
            'communication' => $evaluations->avg('communication'),
            'problem_solving' => $evaluations->avg('problem_solving'),
            'adaptability' => $evaluations->avg('adaptability'),
            'innovation' => $evaluations->avg('innovation'),
            'professionalism' => $evaluations->avg('professionalism'),
        ];

        // Calculer le total pour normaliser les pourcentages
        $total = array_sum($averages);

        $percentages = [];
        foreach ($averages as $key => $value) {
            $percentages[$key] = round(($value / $total) * 100, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Évaluations',
                    'data' => array_values($averages),
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
                'Travail en équipe (' . $percentages['teamwork'] . '%)',
                'Ponctualité (' . $percentages['punctuality'] . '%)',
                'Réactivité (' . $percentages['reactivity'] . '%)',
                'Communication (' . $percentages['communication'] . '%)',
                'Résolution de problèmes (' . $percentages['problem_solving'] . '%)',
                'Adaptabilité (' . $percentages['adaptability'] . '%)',
                'Innovation (' . $percentages['innovation'] . '%)',
                'Professionnalisme (' . $percentages['professionalism'] . '%)',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => [
                    'display' => false,
                ],
                'x' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getStyle(): string
    {
        return '.chart-container {
            background-color: #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }';
    }
}
