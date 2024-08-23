<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalEvaluationResource\Pages;
use App\Models\ProfessionalEvaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Tables\Columns\ProgressColumn;
use Filament\Forms\Components\Section;
use Filament\Tables\Filters\SelectFilter;

class ProfessionalEvaluationResource extends Resource
{
    protected static ?string $model = ProfessionalEvaluation::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Evaluations';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information de l\'Utilisateur')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->description('Sélectionnez l\'utilisateur à évaluer')
                    ->icon('heroicon-o-user'),

                Section::make('Évaluation Professionnelle')
                    ->schema([
                        Forms\Components\TextInput::make('teamwork')
                            ->label('Travail d\'équipe')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('teamwork_comment')
                            ->label('Commentaire sur le travail d\'équipe'),

                        Forms\Components\TextInput::make('punctuality')
                            ->label('Ponctualité')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('punctuality_comment')
                            ->label('Commentaire sur la ponctualité'),

                        Forms\Components\TextInput::make('reactivity')
                            ->label('Réactivité')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('reactivity_comment')
                            ->label('Commentaire sur la réactivité'),

                        Forms\Components\TextInput::make('communication')
                            ->label('Communication')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('communication_comment')
                            ->label('Commentaire sur la communication'),

                        Forms\Components\TextInput::make('problem_solving')
                            ->label('Résolution de problèmes')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('problem_solving_comment')
                            ->label('Commentaire sur la résolution de problèmes'),

                        Forms\Components\TextInput::make('adaptability')
                            ->label('Adaptabilité')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('adaptability_comment')
                            ->label('Commentaire sur l\'adaptabilité'),

                        Forms\Components\TextInput::make('innovation')
                            ->label('Innovation')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('innovation_comment')
                            ->label('Commentaire sur l\'innovation'),

                        Forms\Components\TextInput::make('professionalism')
                            ->label('Professionnalisme')
                            ->numeric()
                            ->required(),
                        Forms\Components\Textarea::make('professionalism_comment')
                            ->label('Commentaire sur le professionnalisme'),
                    ])
                    ->columns(2)
                    ->description('Veuillez évaluer les compétences professionnelles de l\'utilisateur.')
                    ->icon('heroicon-o-briefcase'),

                Section::make('Commentaire Général')
                    ->schema([
                        Forms\Components\Textarea::make('commentaire')
                            ->label('Commentaire Général'),
                    ])
                    ->description('Vous pouvez ajouter des commentaires supplémentaires concernant la performance globale de l\'utilisateur.')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->sortable()
                    ->searchable(),


                ViewColumn::make('evaluations')
                    ->view('tables.columns.evaluation-overview')
                    ->label('Évaluations')
                    ->sortable(false)
                    ->getStateUsing(fn($record) => $record)
                ,
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Utilisateur'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionalEvaluations::route('/'),
            'create' => Pages\CreateProfessionalEvaluation::route('/create'),
            'edit' => Pages\EditProfessionalEvaluation::route('/{record}/edit'),
        ];
    }
}
