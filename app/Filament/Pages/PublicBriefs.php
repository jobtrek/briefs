<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
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
            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->extraAttributes(['class' => 'text-primary']),
            Tables\Columns\TextColumn::make('briefBranch.name')
                ->sortable()
                ->label('Branche')
                ->extraAttributes(['class' => 'text-secondary']),
            Tables\Columns\TextColumn::make('year')
                ->sortable()
                ->label('Année')
                ->extraAttributes(['class' => 'text-secondary']),
            Tables\Columns\TextColumn::make('briefLevel.number')
                ->sortable()
                ->label('Niveau')
                ->extraAttributes(['class' => 'text-secondary']),
            Tables\Columns\IconColumn::make('attachment')
                ->label('PDF')
                ->trueIcon('heroicon-o-document')
                ->url(fn ($record) => asset('storage/' . $record->attachment), shouldOpenInNewTab: true)
                ->extraAttributes(['class' => 'text-primary']),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('year')
                ->label('Année')
                ->options([
                    '1' => '1ère année',
                    '2' => '2ème année',
                    '3' => '3ème année',
                ]),
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
