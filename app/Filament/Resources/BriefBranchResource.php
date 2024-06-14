<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BriefBranchResource\Pages;
use App\Filament\Resources\BriefBranchResource\RelationManagers;
use App\Models\BriefBranch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
class BriefBranchResource extends Resource
{
    protected static ?string $model = BriefBranch::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup ='Mandats';

    protected static ?string $pluralLabel = 'Mandats Branche';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(20),
                Forms\Components\Textarea::make('description')->rows(4)->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->limit(100)->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBriefBranches::route('/'),
            'create' => Pages\CreateBriefBranch::route('/create'),
            'edit' => Pages\EditBriefBranch::route('/{record}/edit'),
        ];
    }
}
