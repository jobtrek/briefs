<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationResource\Pages;
use App\Models\Evaluation;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup = 'Evaluations';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Fieldset::make('Sélections')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->required()
                            ->preload(),

                        Forms\Components\Select::make('brief_id')
                            ->relationship('brief', 'name')
                            ->searchable()
                            ->required()
                            ->preload(),
                    ]),

                Fieldset::make('Évaluations')
                    ->schema([
                        Forms\Components\Repeater::make('criteria')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('criteria_id')
                                    ->relationship('criteria', 'description')
                                    ->required()
                                    ->preload()
                                    ->searchable(),

                                Forms\Components\TextInput::make('note_max')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(50)
                                    ->required(),

                                Forms\Components\TextInput::make('note')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(50)
                                    ->required(),

                                Forms\Components\TextInput::make('commentaire')
                                    ->required()
                                    ->maxLength(250),
                            ])
                            ->defaultItems(1),
                    ]),

                Fieldset::make('Informations générales')
                    ->schema([
                        Forms\Components\Textarea::make('commentaire_general_mandat')
                            ->required()
                            ->label("Commentaire générale apprentis")
                            ->placeholder("Entrez votre commentaire ici..."),

                        Forms\Components\DatePicker::make('date_evaluation')
                            ->required()
                            ->label("Date d'évaluation"),
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
            ->actions([])
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
