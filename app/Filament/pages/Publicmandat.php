<?php

namespace App\Filament\pages;

use App\Filament\Resources\PublicMandatResource;
use Filament\Pages\Page;

class Publicmandat extends Page
{
    protected static string $resource = PublicMandatResource::class;

    public function mount(): void
    {
        // Code pour initialiser la page
    }
}
