<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UserAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }


    protected function getType(): string
    {
        return 'lin';
    }
}
