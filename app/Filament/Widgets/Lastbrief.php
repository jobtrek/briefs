<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BriefResource;
use App\Filament\Resources\BriefRealisationResource;
use App\Filament\Resources\EvaluationResource;
use App\Filament\Resources\UserResource;
use App\Models\Brief;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Lastbrief extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(BriefRealisationResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->columns([

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date de publication')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Apprentis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('brief.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('date_debut')
                    ->searchable()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_fin')
                    ->searchable()
                    ->date()
                    ->sortable(),
            ])




            ->actions([
            ]);
    }
}
