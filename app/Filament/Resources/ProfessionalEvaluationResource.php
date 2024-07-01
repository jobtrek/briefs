<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ProfessionalEvaluationResource\Pages;
use App\Filament\Resources\ProfessionalEvaluationResource\Pages\ProfessionnalEvaluation as ProfessionnalEvaluationWidget;
use App\Models\ProfessionalEvaluation;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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

                BadgeColumn::make('teamwork')
                    ->label('Travail en équipe')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),


                BadgeColumn::make('punctuality')
                    ->label('Ponctualité')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),

                BadgeColumn::make('reactivity')
                    ->label('Réactivité')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),


                BadgeColumn::make('communication')
                    ->label('Communication')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),
                BadgeColumn::make('problem_solving')
                    ->label('Résolution de problèmes')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),

                BadgeColumn::make('adaptability')
                    ->label('Adaptabilité')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),

                BadgeColumn::make('innovation')
                    ->label('Innovation')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),

                BadgeColumn::make('professionalism')
                    ->label('Professionnalisme')
                    ->colors([
                        'success' => fn ($state) => $state == 1,
                        'danger' => fn ($state) => $state == 0,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? '😊' : '😞')
                    ->extraAttributes(['class' => 'text-center']),

                TextColumn::make('commentaire')
                    ->label('Commentaire général')
                    ->extraAttributes(['class' => 'whitespace-normal'])
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

    public static function widgets(): array
    {
        return [
            ProfessionnalEvaluationWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfessionalEvaluations::route('/'),
            'create' => Pages\CreateProfessionalEvaluation::route('/create'),
            'edit' => Pages\EditProfessionalEvaluation::route('/{record}/edit'),
            'view' => Pages\ViewProfessionalEvaluation::route('/{record}'),
        ];
    }
}
