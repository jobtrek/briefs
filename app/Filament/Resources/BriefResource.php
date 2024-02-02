<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BriefResource\Pages;
use App\Filament\Resources\BriefResource\RelationManagers;
use App\Models\Brief;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\View\View;

class BriefResource extends Resource
{
    protected static ?string $model = Brief::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(250),
                Forms\Components\Select::make('brief_branch_id')
                    ->relationship('briefBranch', 'name')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')->required()->maxLength(20),
                        Forms\Components\Textarea::make('description')->rows(4)->required()
                    ]),
                Forms\Components\Select::make('brief_level_id')
                    ->relationship('briefLevel', 'number')
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\FileUpload::make('attachment')
                    ->directory('form-attachments')
                    ->required()->openable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('brief.name')->sortable()->searchable(),
                // other columns...
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('brief')
                    ->relationship('brief', 'name')
                    ->preload(),
                // other filters...
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
            'index' => Pages\ListBriefs::route('/'),
            'create' => Pages\CreateBrief::route('/create'),
            'edit' => Pages\EditBrief::route('/{record}/edit'),
        ];
    }
}
