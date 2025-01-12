<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use App\Models\User;
use App\Models\Issue;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
#use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminWidgets extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count()),
            Stat::make('Users Registered Today', User::whereDate('created_at', today())->count()),
            Stat::make('Issues Created Today', Issue::whereDate('created_at', today())->count()),
        ];
    }
}
