<?php

namespace App\Filament\Resources\ShiftResource\Widgets;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Filament\Resources\ShiftResource\Pages\ListShifts;

class ShiftOverview extends BaseWidget
{

    use InteractsWithPageTable;
    protected function getTablePage(): string
    {
        return ListShifts::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Total Sales', $this->getPageTableQuery()->sum('sales')),
        ];
    }
}
