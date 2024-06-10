<?php

namespace App\Filament\Resources;

use App\Models\Task;
use Filament\Forms;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Actions;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

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

    public function config(): array
    {
        return [
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
            ],
            'initialView' => 'dayGridMonth',
            'editable' => true,
            'selectable' => true,
            'hiddenDays' => [0, 6],
            'dayMaxEvents' => true,
            'eventTimeFormat' => [
                'hour' => '2-digit',
                'minute' => '2-digit',
                'meridiem' => 'short',
            ],
        ];
    }
}
