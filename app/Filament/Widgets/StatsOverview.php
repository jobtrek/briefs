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
        $mandatCount = Brief::query()->count();
        $apprentiCount = User::query()->count();

        return [
            Stat::make('Mandat', $mandatCount)
                ->description('Tous les mandats')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([10,50,3,4,6])
                ->icon('heroicon-o-document-duplicate')
                ->color('success')
                ->extraAttributes(['data-target' => $mandatCount, 'id' => 'mandats-counter']),

            Stat::make('Apprentis', $apprentiCount)
                ->description('Tous les apprentis')
                ->icon('heroicon-o-academic-cap')
                ->chart([7,5,1,4,6,10])
                ->color('success')
                ->extraAttributes(['data-target' => $apprentiCount, 'id' => 'apprentis-counter']),
        ];
    }
}
