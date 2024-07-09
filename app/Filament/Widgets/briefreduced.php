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
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 2,
                    'hoverBackgroundColor' => 'rgba(75, 192, 192, 0.4)',
                    'hoverBorderColor' => 'rgba(75, 192, 192, 1)',
                    'fill' => true,
                    'tension' => 0.4,
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
                            'color' => '#FFFFFF',
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
                        'backgroundColor' => 'rgba(0, 0, 0, 0.7)',
                        'titleColor' => '#FFFFFF',
                        'bodyColor' => '#FFFFFF',
                        'footerColor' => '#FFFFFF',
                    ],
                ],
                'scales' => [
                    'x' => [
                        'ticks' => [
                            'color' => '#FFFFFF',
                            'font' => [
                                'size' => 12,
                            ]
                        ],
                        'grid' => [
                            'color' => 'rgba(255, 255, 255, 0.1)',
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
                'animations' => [
                    'tension' => [
                        'duration' => 1000,
                        'easing' => 'linear',
                        'from' => 1,
                        'to' => 0,
                        'loop' => true,
                    ]
                ],
            ],
        ];
    }
}
