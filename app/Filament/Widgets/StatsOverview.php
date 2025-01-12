<?php

namespace App\Filament\Widgets;

use App\Models\Issue;
use App\Models\Project;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        return [
            Stat::make('New Users', User::count())
                ->description('New Users that have joined')
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('success'),
            Stat::make('Issues', Issue::count())
                ->description('Total Issues')
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->chart([1, 3, 5, 10, 20, 40])
                ->color('success'),
            Stat::make('Total Projects', Project::count())
                ->description('Total Projects')
                ->descriptionIcon('heroicon-s-users', IconPosition::Before)
                ->color('success'),
            Stat::make('Welcome to ', 'Monorail')
                ->description('User: ' . $user->name)
        ];
    }
}
