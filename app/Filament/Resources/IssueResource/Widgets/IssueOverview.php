<?php

namespace App\Filament\Resources\IssueResource\Widgets;

use App\Models\Issue;
use Filament\Widgets\ChartWidget;

class IssueOverview extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            Issue::query()->latest()
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
