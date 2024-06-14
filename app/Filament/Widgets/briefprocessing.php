<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\BriefRealisation;

class briefprocessing extends ChartWidget
{
    protected static ?string $heading = 'Mandats en cours';
    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        $processings = BriefRealisation::with('status', 'processing')
            ->selectRaw('COUNT(*) as count, EXTRACT(MONTH FROM created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('M', mktime(0, 0, 0, $month, 1));
            $data[] = $processings->get($month, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Mandats en cours',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)', // Bleu avec transparence
                    'borderColor' => 'rgba(54, 162, 235, 1)', // Bleu sans transparence
                    'borderWidth' => 2,
                    'hoverBackgroundColor' => 'rgba(54, 162, 235, 0.75)',
                    'hoverBorderColor' => 'rgba(54, 162, 235, 1)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getConfiguration(): array
    {
        return [
            'type' => $this->getType(),
            'data' => $this->getData(),
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'legend' => [
                        'display' => true,
                        'labels' => [
                            'color' => '#FFFFFF', // Blanc pour les étiquettes de légende
                            'font' => [
                                'size' => 14,
                                'family' => 'Arial, sans-serif'
                            ]
                        ],
                    ],
                    'tooltip' => [
                        'enabled' => true,
                        'mode' => 'index',
                        'intersect' => false,
                        'backgroundColor' => 'rgba(0, 0, 0, 0.7)', // Fond semi-transparent noir pour les infobulles
                        'titleColor' => '#FFFFFF',
                        'bodyColor' => '#FFFFFF',
                        'footerColor' => '#FFFFFF',
                    ],
                ],
                'scales' => [
                    'x' => [
                        'ticks' => [
                            'color' => '#FFFFFF', // Blanc pour les étiquettes des axes
                            'font' => [
                                'size' => 12,
                            ]
                        ],
                        'grid' => [
                            'color' => 'rgba(255, 255, 255, 0.1)', // Grille avec une légère transparence
                        ]
                    ],
                    'y' => [
                        'ticks' => [
                            'color' => '#FFFFFF',
                            'font' => [
                                'size' => 12,
                            ],
                            'beginAtZero' => true,
                        ],
                        'grid' => [
                            'color' => 'rgba(255, 255, 255, 0.1)',
                        ]
                    ],
                ],
            ],
        ];
    }
}
