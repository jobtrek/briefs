<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BriefResource\Pages;
use App\Models\Brief;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;

class BriefResource extends Resource
{
    protected static ?string $model = Brief::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Mandats';
    protected static ?string $pluralLabel = 'Mandats';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make('name')
                        ->label('Nom du mandat')
                        ->placeholder('Entrez le nom du mandat')
                        ->required()
                        ->maxLength(250),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('brief_branch_id')
                            ->relationship('briefBranch', 'name')
                            ->label('Branche')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')->required()->maxLength(20),
                                Forms\Components\Textarea::make('description')->rows(4)->required()
                            ]),

                        Forms\Components\Select::make('brief_level_id')
                            ->relationship('briefLevel', 'number')
                            ->label('Niveau')
                            ->required()
                            ->preload()
                            ->searchable(),
                    ]),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('year')
                            ->label('Année')
                            ->options(['1' => '1ère année', '2' => '2ème année', '3' => '3ème année'])
                            ->required(),

                        Forms\Components\Select::make('semester')
                            ->label('Semestre')
                            ->options(['1' => 'Semestre 1', '2' => 'Semestre 2'])
                            ->required(),
                    ]),

                    Forms\Components\FileUpload::make('attachment')
                        ->label('Fichier joint')
                        ->directory('form-attachments')
                        ->required()
                        ->openable()
                        ->reactive(),
                ])->columns(1)->columnSpan('full'),

            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('briefBranch.name')->sortable()->label('Branche'),
                Tables\Columns\TextColumn::make('year')->sortable()->label('Année'),
                Tables\Columns\TextColumn::make('semester')->sortable()->label('Semestre'),
                Tables\Columns\TextColumn::make('briefLevel.number')->sortable()->label('Niveau'),
                Tables\Columns\IconColumn::make('attachment')
                    ->label('PDF')
                    ->trueIcon('heroicon-o-document')
                    ->url(fn ($record) => asset('storage/' . $record->attachment), shouldOpenInNewTab: true)
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('briefBranch')
                    ->relationship('briefBranch', 'name')->preload()
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
        return [];
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
