<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalEvaluationResource\Pages;
use App\Models\ProfessionalEvaluation;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Illuminate\Support\HtmlString;

class ProfessionalEvaluationResource extends Resource
{
    protected static ?string $model = ProfessionalEvaluation::class;
    protected static ?string $navigationIcon = 'heroicon-o-face-smile';
    protected static ?string $navigationGroup = 'Evaluations';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->required()
                            ->label('Apprentis')
                            ->preload(),

                        Grid::make(2)
                            ->schema([
                                Radio::make('teamwork')
                                    ->label('Travail en équipe')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('teamwork_comment')
                                    ->label('Commentaire sur le Travail en équipe')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('punctuality')
                                    ->label('Ponctualité')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('punctuality_comment')
                                    ->label('Commentaire sur la Ponctualité')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('reactivity')
                                    ->label('Réactivité')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('reactivity_comment')
                                    ->label('Commentaire sur la Réactivité')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('communication')
                                    ->label('Communication')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('communication_comment')
                                    ->label('Commentaire sur la Communication')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('problem_solving')
                                    ->label('Résolution de problèmes')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('problem_solving_comment')
                                    ->label('Commentaire sur la Résolution de problèmes')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('adaptability')
                                    ->label('Adaptabilité')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('adaptability_comment')
                                    ->label('Commentaire sur l\'Adaptabilité')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('innovation')
                                    ->label('Innovation')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('innovation_comment')
                                    ->label('Commentaire sur l\'Innovation')
                                    ->placeholder("Entrez votre commentaire ici..."),

                                Radio::make('professionalism')
                                    ->label('Professionnalisme')
                                    ->options([
                                        1 => '😊',
                                        0 => '😞',
                                    ])
                                    ->inline()
                                    ->required(),
                                Textarea::make('professionalism_comment')
                                    ->label('Commentaire sur le Professionnalisme')
                                    ->placeholder("Entrez votre commentaire ici..."),
                            ]),

                        Textarea::make('commentaire')
                            ->label('Commentaire général')
                            ->placeholder("Entrez votre commentaire ici..."),
                    ]),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Utilisateur')
                    ->searchable(),

                TextColumn::make('teamwork')
                    ->label('Travail en équipe')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('teamwork_comment')
                    ->label('Commentaire sur le Travail en équipe'),

                TextColumn::make('punctuality')
                    ->label('Ponctualité')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('punctuality_comment')
                    ->label('Commentaire sur la Ponctualité'),

                TextColumn::make('reactivity')
                    ->label('Réactivité')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('reactivity_comment')
                    ->label('Commentaire sur la Réactivité'),

                TextColumn::make('communication')
                    ->label('Communication')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('communication_comment')
                    ->label('Commentaire sur la Communication'),

                TextColumn::make('problem_solving')
                    ->label('Résolution de problèmes')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('problem_solving_comment')
                    ->label('Commentaire sur la Résolution de problèmes'),

                TextColumn::make('adaptability')
                    ->label('Adaptabilité')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('adaptability_comment')
                    ->label('Commentaire sur l\'Adaptabilité'),

                TextColumn::make('innovation')
                    ->label('Innovation')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('innovation_comment')
                    ->label('Commentaire sur l\'Innovation'),

                TextColumn::make('professionalism')
                    ->label('Professionnalisme')
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞'),
                TextColumn::make('professionalism_comment')
                    ->label('Commentaire sur le Professionnalisme'),

                TextColumn::make('commentaire')
                    ->label('Commentaire général')
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
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
