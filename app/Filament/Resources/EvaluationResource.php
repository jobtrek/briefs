<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationResource\Pages;
use App\Filament\Resources\EvaluationResource\RelationManagers;
use App\Models\Evaluation;
use Faker\Core\Number;
use Faker\Provider\ar_EG\Text;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Range;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nette\Utils\Type;
use Spatie\Permission\Guard;
use function Laravel\Prompts\note;
use Filament\Tables\Columns\Summarizers\Average;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationGroup ='Evaluations';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Sélections')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->searchable()
                            ->relationship('user', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ,
                        Forms\Components\Select::make('brief_id')
                            ->relationship('brief', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ,
                    ]),

                Fieldset::make('Évaluations')
                    ->schema([
                        Forms\Components\Repeater::make('une new evaluation')
                            ->columnSpan(4)
                            ->schema([
                                Forms\Components\Select::make('criteria_id')
                                    ->searchable()
                                    ->relationship('criteria', 'description')
                                    ->required()
                                    ->preload()
                                    ->searchable(),
                                Forms\Components\TextInput::make('note_max')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(50)
                                    ->required()
                                ,
                                Forms\Components\TextInput::make('note')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(50)
                                    ->required()
                                ,
                                Forms\Components\TextInput::make('commentaire')
                                    ->required()
                                    ->maxLength(250)
                               ,
                            ])
                            ->defaultItems(1),
                    ]),

                Fieldset::make('Informations générales')
                    ->schema([
                        Forms\Components\Textarea::make('commentaire_general_mandat')
                            ->required()
                            ->label("Commentaire générale apprentis")
                            ->placeholder("Entrez votre commentaire ici...")
                       ,
                        Forms\Components\DatePicker::make('date_evaluation')
                            ->required()
                            ->label("Date d'évaluation")
                         ,
                    ]),
            ]);
    }

    /**w
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Apprentis')
                    ->searchable(),
                TextColumn::make('brief.name')
                    ->label('mandats')
                    ->searchable(),
                TextColumn::make('commentaire_general_mandat')
                    ->label('Commentaire général'),

            ])
            ->filters([
                SelectFilter::make('brief_id')
                    ->label('Filtrer par Brief')
                    ->options(\App\Models\Brief::pluck('name', 'id')->toArray()),
            ])
            ->actions([

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
            'index' => Pages\ListEvaluations::route('/'),
            'create' => Pages\CreateEvaluation::route('/create'),
            'edit' => Pages\EditEvaluation::route('/{record}/edit'),
        ];
    }
}
