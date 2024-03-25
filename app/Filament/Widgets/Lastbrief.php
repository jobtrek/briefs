<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BriefResource;
use App\Filament\Resources\BriefRealisationResource;
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
            ->query(BriefResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('briefrealisation.user.name')                     ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),


                Tables\Columns\TextColumn::make('mandats en cours ')
                    ->label('mandats en cours')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('Date debut')
                    ->searchable()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Date fin')
                    ->searchable()
                    ->date()
                    ->sortable(),
            ])
            ->actions([
            ]);
    }
}
