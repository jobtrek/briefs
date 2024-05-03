<?php

namespace App\Filament\Widgets;


use App\Models\Brief;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Brief', Brief::query()->count())
                ->description('Tous les mandats')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([10,50,3,4,6])
                ->color('success'),

            Stat::make('User', User::query()->count())
                ->description('Tous les users')
                ->chart([7,5,1,4,6,10])
                ->color('success'),
        ];

    }


}
