<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationResource\Pages;
use App\Filament\Resources\EvaluationResource\RelationManagers;
use App\Models\Evaluation;
use Faker\Core\Number;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nette\Utils\Type;

class EvaluationResource extends Resource
{
    protected static ?string $model = Evaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\MultiSelect::make('criteria_id')
                    ->searchable()
                    ->relationship('criteria', 'description')
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\Select::make('brief_id')
                    ->relationship('brief', 'name')
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\TextInput::make('note')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(20)
                    ->required(),

                Forms\Components\RichEditor::make('commentaire')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('criteria.description'),
                Tables\Columns\TextColumn::make('evaluationCriteria.note')->label('Note'),
                Tables\Columns\TextColumn::make('evaluationCriteria.commentaire')->label('Commentaire'),
            ])

            ->filters([
                SelectFilter::make('brief_id')
                    ->label('Filtrer par Brief')
                    ->options(

                        \App\Models\Brief::pluck('name', 'id')->toArray()
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()            ])
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
