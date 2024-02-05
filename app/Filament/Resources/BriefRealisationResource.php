<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BriefRealisationResource\Pages;
use App\Filament\Resources\BriefRealisationResource\RelationManagers;
use App\Models\BriefRealisation;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BriefRealisationResource extends Resource
{
    protected static ?string $model = BriefRealisation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('brief_id')
                    ->relationship('brief', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\DateTimePicker::make('date_debut')
                    ->required(),

                Forms\Components\DateTimePicker::make('date_fin')
                    ->required(),


            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brief.name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('date_debut'),
                Tables\Columns\TextColumn::make('date_fin'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBriefRealisations::route('/'),
            'create' => Pages\CreateBriefRealisation::route('/create'),
            'edit' => Pages\EditBriefRealisation::route('/{record}/edit'),
        ];
    }
}
