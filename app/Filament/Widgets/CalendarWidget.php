<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Filament\Forms;
use Saade\FilamentFullCalendar\Actions;

class CalendarWidget extends FullCalendarWidget
{
    public Model | string | null $model = Task::class;

    public function fetchEvents(array $fetchInfo): array
    {
        return Task::where('start', '>=', $fetchInfo['start'])
            ->where('end', '<=', $fetchInfo['end'])
            ->get()
            ->map(function (Task $task) {
                return [
                    'id'    => $task->id,
                    'title' => $task->name,
                    'start' => $task->start,
                    'end'   => $task->end,
                ];
            })
            ->toArray();
    }

    public static function canView(): bool
    {
        return true;
    }

    protected function headerActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    return [
                        ...$data,
                        'calendar_id' => $this->record->id ?? null,
                    ];
                })
                ->mountUsing(function (Forms\Form $form, array $arguments) {
                    $form->fill([
                        'start' => $arguments['start'] ?? null,
                        'end' => $arguments['end'] ?? null,
                    ]);
                }),
        ];
    }

    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Grid::make()
                ->schema([
                    Forms\Components\DateTimePicker::make('start')->required(),
                    Forms\Components\DateTimePicker::make('end')->required(),
                ]),
        ];
    }
}
