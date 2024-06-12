<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationResource\Pages;
use App\Models\Evaluation;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Evaluations';
    protected static ?string $pluralLabel = 'Mes évaluations';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Fieldset::make('Sélections')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->searchable()
                                    ->required()
                                    ->preload()
                                    ->columnSpan(1),
                                Forms\Components\Select::make('brief_id')
                                    ->relationship('brief', 'name')
                                    ->searchable()
                                    ->required()
                                    ->selectablePlaceholder("criteria_id")
                                    ->preload()
                                    ->columnSpan(1),
                            ]),
                    ]),

                Fieldset::make('Évaluations')
                    ->schema([
                        Forms\Components\Repeater::make('criteria')
                            ->relationship()
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        Forms\Components\Select::make('criteria_id')
                                            ->relationship('criteria', 'description')
                                            ->required()
                                            ->preload()
                                            ->searchable()
                                            ->label('Critères')
                                            ->columnSpan(1),

                                        TextInput::make('note_max')
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(50)
                                            ->required()
                                            ->label('Note MAX')
                                            ->columnSpan(1),

                                        TextInput::make('note')
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(50)
                                            ->required()
                                            ->label('Note')
                                            ->columnSpan(1),

                                        TextInput::make('commentaire')
                                            ->required()
                                            ->maxLength(250)
                                            ->label('Commentaire')
                                            ->columnSpan(1),
                                    ]),
                            ])
                            ->defaultItems(3)
                            ->columnSpan('full'),
                    ]),

                Fieldset::make('Informations générales')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Textarea::make('commentaire_general_mandat')
                                    ->required()
                                    ->label("Commentaire générale apprentis")
                                    ->placeholder("Entrez votre commentaire ici...")
                                    ->columnStart(1)
                                    ->autosize()
                                    ->columnSpan(1),

                                Forms\Components\DatePicker::make('date_evaluation')
                                    ->required()
                                    ->label("Date d'évaluation")
                                ->columnStart(2)
                                    ->columnSpan(1)
                                ,
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Apprentis')
                    ->searchable(),

                TextColumn::make('brief.name')
                    ->label('Mandats')
                    ->searchable(),

                TextColumn::make('commentaire_general_mandat')
                    ->label('Commentaire général'),

                TextColumn::make('note')
                    ->label('Moyenne des notes')
                    ->getStateUsing(fn (Evaluation $record) => $record->average_note),
            ])



            ->filters([
                SelectFilter::make('user_id')
                    ->label('Filtrer par Apprentis')
                    ->options(\App\Models\User::pluck('name', 'id')->toArray()),
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
            'index' => Pages\ListEvaluations::route('/'),
            'create' => Pages\CreateEvaluation::route('/create'),
            'edit' => Pages\EditEvaluation::route('/{record}/edit'),
        ];
    }
}
