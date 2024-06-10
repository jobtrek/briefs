<?php

namespace App\Filament\Pages;

use Filament\Enums\ThemeMode;
use Filament\Pages\Page;
use Filament\Panel;
use Filament\Tables;
use App\Models\Brief;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Builder;

class PublicBriefs extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static string $view = 'filament.pages.public-briefs';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }


    protected function getTableQuery(): Builder
    {
        return Brief::query();
    }


    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('briefBranch.name')->sortable()->label('Branche'),
            Tables\Columns\TextColumn::make('year')->sortable()->label('Année'),
            Tables\Columns\TextColumn::make('briefLevel.number')->sortable()->label('Niveau'),
            Tables\Columns\IconColumn::make('attachment')
                ->label('PDF')
                ->trueIcon('heroicon-o-document')
                ->url(fn ($record) => asset('storage/' . $record->attachment), shouldOpenInNewTab: true)
        ];
    }

    protected function getTableActions(): array
    {
        return [];
    }

    protected function getTableBulkActions(): array
    {
        return [];
    }
}
