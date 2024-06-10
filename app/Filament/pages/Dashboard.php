<?php

namespace App\Filament\pages;

use Filament\Facades\Filament;

class Dashboard
{
    protected function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\briefprocessing::class,
            \App\Filament\Widgets\briefreduced::class,
        ];
    }
}
