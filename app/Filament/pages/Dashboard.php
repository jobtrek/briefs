<?php

namespace App\Filament\pages;

use App\Filament\Widgets\StatsOverview;

class Dashboard
{
    protected function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\briefprocessing::class,
            \App\Filament\Widgets\briefreduced::class,
            StatsOverview::class,

        ];
    }
}
