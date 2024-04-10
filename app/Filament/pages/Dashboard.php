<?php

namespace App\Filament\pages;

use Filament\Facades\Filament;

class Dashboard
{
    public function getWidgets(): array

    {
        return Filament::getWidgets();


    }

}
