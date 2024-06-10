<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\BriefRealisation;

class briefreduced extends ChartWidget
{
    protected static ?string $heading = 'Mandats délivrés';
    protected static ?int $sort = 3;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        $reducedBriefs = BriefRealisation::with('status', 'delivered')
            ->selectRaw('COUNT(*) as count, EXTRACT(MONTH FROM created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('M', mktime(0, 0, 0, $month, 1));
            $data[] = $reducedBriefs->get($month, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Mandats délivrés',
                    'data' => $data,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Vert avec transparence
                    'borderColor' => 'rgba(75, 192, 192, 1)', // Vert sans transparence
                    'borderWidth' => 2,
                    'hoverBackgroundColor' => 'rgba(75, 192, 192, 0.4)',
                    'hoverBorderColor' => 'rgba(75, 192, 192, 1)',
                    'fill' => true,
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
