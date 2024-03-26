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

        // Formater les données pour le graphique
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('M', mktime(0, 0, 0, $month, 1));
            $data[] = $processings->get($month, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Mandats en cours',
                    'data' => $data,
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }
}
