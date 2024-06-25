<?php

namespace App\Filament\pages;

use App\Filament\Widgets\StatsOverview;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Notification;

class Dashboard
{
    protected function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\briefprocessing::class,
            \App\Filament\Widgets\briefreduced::class,
            StatsOverview::class,

        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updateProfile')
                ->label('Update Profile')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->autofocus(),
                ])
                ->action(function (array $data) {
                    $user = User::find(auth()->id());

                    if (!$user) {
                        throw new \Exception('User not found.');
                    }

                    $user->update(['name' => $data['name']]);

                    Notification::make()
                        ->title('Profile Updated')
                        ->success()
                        ->sendToDatabase($user);

                    event(new DatabaseNotificationsSent($user));
                }),
        ];
    }
}
