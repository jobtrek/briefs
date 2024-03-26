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

        // Formater les données pour le graphique
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = date('M', mktime(0, 0, 0, $month, 1));
            $data[] = $reducedBriefs->get($month, 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Mandats réduits délivrés',
                    'data' => $data,
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }
}
