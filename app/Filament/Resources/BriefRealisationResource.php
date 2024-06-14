<?php

namespace App\Filament\Resources;

use App\Enums\BriefStatus;
use App\Filament\Resources\BriefRealisationResource\Pages;
use App\Models\BriefRealisation;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class BriefRealisationResource extends Resource
{
    protected static ?string $model = BriefRealisation::class;
    protected static ?string $navigationGroup = 'Mandats';
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $pluralLabel = 'Mandats Realisés';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('brief_id')
                    ->relationship('brief', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),
                DateTimePicker::make('date_debut')
                    ->required(),
                DateTimePicker::make('date_fin')
                    ->required(),
                ToggleButtons::make('status')
                    ->inline()
                    ->options(BriefStatus::class)
                    ->required(),
            ]);
    }
    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('brief.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name'),
                TextColumn::make('date_debut'),
                TextColumn::make('date_fin'),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                Filter::make('user')
                    ->form([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->preload()
                            ->searchable(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['user_id'],
                            fn (Builder $query, $userId) => $query->whereRelation('user', 'id', $userId),
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) BriefRealisation::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBriefRealisations::route('/'),
            'create' => Pages\CreateBriefRealisation::route('/create'),
            'edit' => Pages\EditBriefRealisation::route('/{record}/edit'),
        ];
    }
}
