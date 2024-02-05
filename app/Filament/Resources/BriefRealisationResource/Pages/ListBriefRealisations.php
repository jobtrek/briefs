<?php

namespace App\Filament\Resources\BriefRealisationResource\Pages;

use App\Filament\Resources\BriefRealisationResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListBriefRealisations extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = BriefRealisationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return BriefRealisationResource::getWidgets();
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'new' => Tab::make()->query(fn ($query) => $query->where('status', 'new')),
            'processing' => Tab::make()->query(fn ($query) => $query->where('status', 'processing')),
            'delivered' => Tab::make()->query(fn ($query) => $query->where('status', 'delivered')),
            'Delivered' => Tab::make()->query(fn ($query) => $query->where('status', 'Delivered')),
        ];
    }
}
